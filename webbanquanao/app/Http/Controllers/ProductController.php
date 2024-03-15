<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\ImageProduct;
use App\Models\CategoriesModel;
use App\Conponents\Recusives;
use Illuminate\Support\Str;
use App\Http\Requests\ProductValidation;
use Illuminate\Http\Request;
use App\Enums\ProductStatus;
use App\Traits\StorageTraits;
use DataTables;
use View;
use DB;
use Log;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    protected $product;
    protected $imageProduct;
    protected $category;
    protected $storagetrait;

    function __construct(){
        $this->category = new CategoriesModel();
        $this->product = new ProductModel();
        $this->imageProduct = new ImageProduct();
        $this->storagetrait = new StorageTraits();
        $productStatus  = ProductStatus::getArrStatus();
        View::share('productStatus', $productStatus);
    }
    public function getCategory($parentid){
        $data = $this->category->all();
        $recusive = new Recusives($data);
        $htmlSelect = $recusive->categoryRecusive($parentid);
        return $htmlSelect;
    }

    public function show()
    {
        return view('dashboard.admin.products.list');
    }
    public function index(Request $request)
    {
 
        if ($request->ajax()) {
            // $data = ProductModel::join('categories', 'products.category_id', '=', 'categories.id')
            // ->select('products.*', 'categories.name as category_name')
            // ->get();
            $data = ProductModel::join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category_name')
                ->paginate(30);

            return DataTables::of($data->toArray())
                ->addIndexColumn()
                ->addColumn('action', function($id){
                    $linkedit =route("edit_product",$id);
                    $linkDelete = route("delete_product",$id);
                    $actionBtn = "<a href='$linkedit' class='btn btn-success btn-sm' style='margin-right: 5px'>Edit</a><a data-url='$linkDelete' class='btn btn-danger btn-sm deleteProduct'>Delete</a>";
                    return $actionBtn;
                })
                ->editColumn('price', function($object){
                    return number_format($object->price)." VND";
                })
                ->rawColumns(['action'])
                ->make(true);
                // ->toJson();
        }
        // return view('dashboard.admin.products.list');

    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $htmlSelect = $this->getCategory($parentid = "");
        return view('dashboard.admin.products.add',compact('htmlSelect'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductValidation $request)
    {

        try {
            DB::beginTransaction();
                $createProduct = $request->except('_token','filepath');
                $createProduct['slug'] = Str::slug($request->name);
                $createProduct['code'] = '#'.Carbon::now()->second.Carbon::now()->minute.Carbon::now()->hour.Carbon::now()->day.Carbon::now()->month.Carbon::now()->year;
                $productNew = $this->product->create($createProduct);
                $file_path = $request->input('filepath');
                if($file_path){
                    $imageUrls = explode(',', $file_path);
                        foreach ($imageUrls as $item) {
                            $this->imageProduct->create([
                                'product_id'=>$productNew->id,
                                'code_image'=>$item,
                                'name'=>basename($item)
                            ]);  
                    }
                }
            DB::commit();
            return redirect()->route('show_list_product');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $product = $this->product->find($id);
        $imagePro = $this->imageProduct->where('product_id',$id)->get();
        $htmlSelect = $this->getCategory($product->category_id);
        return view('dashboard.admin.products.update',compact('htmlSelect','product','imagePro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductValidation $request)
    {
        try {
            DB::beginTransaction();

                $product = $this->product->find($request->id);
                $updateProduct = $request->except('_token','filepath');
                $updateProduct['slug'] = Str::slug($request->name);
                $updateProduct['code'] = $product->code;
                $productNew = $product->update($updateProduct);
                $file_path = $request->input('filepath');
                if($file_path !== 'abc'){
                    $imageUrls = explode(',', $file_path);
                    if($imageUrls){
                        $this->imageProduct->where('product_id',$request->id)->delete();
                        foreach ($imageUrls as $item) {
                            $this->imageProduct->create([
                                'product_id'=>$request->id,
                                'code_image'=>$item,
                                'name'=>basename($item)
                            ]);
                        }
                    }
                }
            DB::commit();
            return redirect()->route('show_list_product');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->product->find($id)->delete();
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

    public function fileExport() 
    {
        // return (new ProductExport(3))->download('list-product-collection.xlsx');
        return Excel::download(new ProductExport, 'list-product-collection.xlsx');
    } 
}
