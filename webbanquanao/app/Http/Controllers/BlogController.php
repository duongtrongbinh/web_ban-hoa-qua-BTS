<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use Illuminate\Http\Request;
use App\Traits\StorageTraits;


class BlogController extends Controller
{
    protected $storageTraits;
    protected $blog;
    
    function __construct(){
        $this->storageTraits = new StorageTraits();
        $this->blog = new BlogModel();
    }
       /**
     * Display a listing of the resource.
     */
    public function show()
    {
        $listBlog = $this->blog->paginate();
        return view('dashboard.admin.blogs.list',compact('listBlog'));
    }
    // public function index(Request $request)
    // {
  
    //     if ($request->ajax()) {
    //         $data = BlogModel::latest()->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($id){
    //                 $linkedit =route("edit_blog",$id);
    //                 $linkDelete = route("delete_blog",$id);
    //                 $actionBtn = "<a href='$linkedit' class='btn btn-success btn-sm' style='margin-right: 5px'>Edit</a><a data-url='$linkDelete' class='btn btn-danger btn-sm deleteBlog'>Delete</a>";
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.blogs.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
        $imageBlog = $this->storageTraits->storageTraitUploadMuity($request->code, 'blog');
        $this->blog->create([
            'title'=>$request->title,
            'name_image'=>$imageBlog['file_name'],
            'code_image'=>$imageBlog['file_path'],
            'user_id'=>auth()->id( ),
            'content'=>$request->content
        ]);

        return redirect()->route('show_list_blog');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
 
        $blog = $this->blog->find($id);
        return view('dashboard.admin.blogs.update',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = $this->blog->find($id);
        $imm = $blog->name_image;
        if((!$request->code) || ($imm == $request->code)){
            $blog->update([
                'title'=>$request->title,
                'name_image'=>$blog->name_image,
                'code_image'=>$blog->code_image,
                'user_id'=>$blog->user_id,
                'content'=>$request->content
            ]);

        }else{
            $imageBlog = $this->storageTraits->storageTraitUploadMuity($request->code, 'blog');
            $blog->update([
                'title'=>$request->title,
                'name_image'=>$imageBlog['file_name'],
                'code_image'=>$imageBlog['file_path'],
                'user_id'=>$blog->user_id,
                'content'=>$request->content
            ]);
            
        } 
        
        return redirect()->route('show_list_blog');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->blog->find($id)->delete();
                return response()->json([
                    'code' => 200,
                    "message" => "success"
                ], 200);
            } catch (\Exception $exception) {
                Log::error("message: " . $exception->getMessage());
                return response()->json([
                    'code' => 500,
                    "message" => "false"
                ], 500);
            }
    }
}
