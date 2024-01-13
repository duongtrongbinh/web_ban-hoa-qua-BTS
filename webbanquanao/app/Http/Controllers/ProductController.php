<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\ImageProduct;
use App\Models\CategoriesModel;
use App\Conponents\Recusives;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Enums\ProductStatus;
use App\Traits\StorageTraits;

use View;
use DB;
use Log;
use Carbon\Carbon;

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
    public function index()
    {
        $count = 0;
        $product =$this->product->get();
        return view('dashboard.admin.products.list',compact('product','count'));
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
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
                $createProduct = $request->except('_token','code');
                $createProduct['slug'] = Str::slug($request->name);
                $createProduct['code'] = '#'.Carbon::now()->minute.Carbon::now()->hour.Carbon::now()->day.Carbon::now()->month.Carbon::now()->year;
                $productNew = $this->product->create($createProduct);
                if($request->hasFile('code')){
                    foreach ($request->code as $item) {
                        $dataImageMui = $this->storagetrait->storageTraitUploadMuity($item, 'product');
                        $this->imageProduct->create([
                            'product_id'=>$productNew->id,
                            'code_image'=>$dataImageMui['file_path'],
                            'name'=>$dataImageMui['file_name']
                        ]);
                    }
                }
            DB::commit();
            return redirect()->route('list_product');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }
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
        $product = $this->product->find($id);
        $imagePro = $this->imageProduct->where('product_id',$id)->get();
        $htmlSelect = $this->getCategory($product->category_id);
        return view('dashboard.admin.products.update',compact('htmlSelect','product','imagePro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
                $product = $this->product->find($request->id);
                $updateProduct = $request->except('_token','code');
                $updateProduct['slug'] = Str::slug($request->name);
                $updateProduct['code'] = $product->code;
                $productNew = $product->update($updateProduct);
                if($request->hasFile('code')){
                    foreach ($request->code as $item) {
                        $this->imageProduct->where('product_id',$request->id)->delete();
                        $dataImageMui = $this->storagetrait->storageTraitUploadMuity($item, 'product');
                        $this->imageProduct->create([
                            'product_id'=>$request->id,
                            'code_image'=>$dataImageMui['file_path'],
                            'name'=>$dataImageMui['file_name']
                        ]);
                    }
                }
            DB::commit();
            return redirect()->route('list_product');
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
}
