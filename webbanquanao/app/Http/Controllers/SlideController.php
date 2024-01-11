<?php

namespace App\Http\Controllers;

use App\Models\SlideModel;
use Illuminate\Http\Request;
use App\Traits\StorageTraits;
use App\Models\CategoriesModel;
use App\Conponents\Recusives;


class SlideController extends Controller
{
    protected $storageTraits;
    protected $slide;
    protected $category;
    
    function __construct(){
        $this->storageTraits = new StorageTraits();
        $this->slide = new SlideModel();
        $this->category = new CategoriesModel();
    }
    public function getCategory($parentid){
        $data = $this->category->all();
        $recusive = new Recusives($data);
        $htmlSelect = $recusive->categoryRecusive($parentid);
        return $htmlSelect;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = $this->slide->all();
        return view('dashboard.admin.slides.list',compact('list'));
    }
    // list api 
    function indexapi(){
        $list = $this->slide->all();
        
        return response()->json($list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $htmlSelect = $this->getCategory($parentid = "");
        return view('dashboard.admin.slides.add',compact('htmlSelect'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $imageSlide = $this->storageTraits->storageTraitUploadMuity($request->code_image, 'slide');
        $this->slide->create([
            'title'=>$request->title,
            'desc'=>$request->description,
            'name_image'=>$imageSlide['file_name'],
            'code_image'=>$imageSlide['file_path'],
            'status'=>0,
            'category_id'=>$request->category_id
        ]);

        return redirect()->route('list_slide');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slide = $this->slide->find($id);
        return view('dashboard.admin.slides.update',compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $slide = $this->slide->find($id);
        $imm = $slide->name_image;
        if((!$request->code_image) || ($imm == $request->code_image)){

            $slide->update([
                'title'=>$request->title,
                'desc'=>$request->desc,
                'name_image'=>$slide->name_image,
                'code_image'=>$slide->code_image,
                'status'=>0,
                'category_id'=>$slide->category_id
            ]);

        }else{
            $imageSlide = $this->storageTraits->storageTraitUploadMuity($request->code_image, 'slide');

                $slide->update([
                    'title'=>$request->title,
                    'desc'=>$request->desc,
                    'name_image'=>$imageSlide['file_name'],
                    'code_image'=>$imageSlide['file_path'],
                    'status'=>0,
                    'category_id'=>$slide->category_id
                ]);
            
        } 
        
        return redirect()->route('list_slide');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        $this->slide->find($id)->delete();
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
