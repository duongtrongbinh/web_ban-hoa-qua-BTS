<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function login(LoginRequest $request){
        $user = $request->except("_token");
        $response1 = Http::post(env('API_URL').env('Login'), $user);
        $useri = $response1->json();
        // dd($useri);
        if(!isset($useri['message'])){
        session(['user' => [
            'token' => $useri['token'],
            'id' => $useri['id'],
        ]]);
        // dd(session()->get('user'));
        return redirect()->route('home');
        }else{
            return redirect()->route('login')->withInput()->withErrors(['loginError' => 'Tài khoản hoặc mật khẩu không đúng.']);
        }

    }

    public function register(RegisterRequest $request){
        $user = $request->except("_token");
        $response1 = Http::post(env('API_URL').env('Register'), $user);
        $useri = $response1->json();
        if(isset($useri['message1'])){
            $messe = $useri['message1'];
            return redirect()->route('login',compact('messe'));
        }else if(isset($useri['message2'])){
            return redirect()->route('register')->withInput()->withErrors(['loginError' => ' Tạo tài khoản thất bại.']);
        } else{
            return redirect()->route('register')->withInput()->withErrors(['loginError' => 'email đã tồn tại trong hệ thống.']);
        }
    }

    public function logout(){

    }
    public function showUser(){
        $xx = session()->get('user');
        if($xx){
        $response = Http::withHeaders(['Authorization' => 'Bearer '.$xx['token'] ,])->get(env('API_URL').env('User').$xx['id']);
        $user = $response->json();
        // dd($user);
        return view('pages.myaccount.profile',compact('user'));
        }
    }
}




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
        $data = $this->category->paginate();
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
            $data = ProductModel::join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category_name')
                ->paginate(30);

            // return DataTables::of($data->toArray())
            //     ->addIndexColumn()
            //     ->addColumn('action', function($id){
            //         $linkedit =route("edit_product",$id);
            //         $linkDelete = route("delete_product",$id);
            //         $actionBtn = "<a href='$linkedit' class='btn btn-success btn-sm' style='margin-right: 5px'>Edit</a><a data-url='$linkDelete' class='btn btn-danger btn-sm deleteProduct'>Delete</a>";
            //         return $actionBtn;
            //     })
            //     ->editColumn('price', function($object){
            //         return number_format($object->price)." VND";
            //     })
            //     ->rawColumns(['action'])
            //     ->make(true);
                // ->toJson();
        // }
        return view('dashboard.admin.products.list',compact('data'));

    }
    

  
    public function create()
    {
        $htmlSelect = $this->getCategory($parentid = "");
        return view('dashboard.admin.products.add',compact('htmlSelect'));
    }


    public function store(ProductValidation $request)
    {

        try {
            DB::beginTransaction();
                $createProduct = $request->except('filepath');
                $createProduct['slug'] = Str::slug($request->name);
                $createProduct['code'] = '#'.now();
                // $createProduct['code'] = '#'.Carbon::now()->second.Carbon::now()->minute.Carbon::now()->hour.Carbon::now()->day.Carbon::now()->month.Carbon::now()->year;
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


    public function edit(string $id)
    {

        $product = $this->product->find($id);
        $imagePro = $this->imageProduct->where('product_id',$id)->get();
        $htmlSelect = $this->getCategory($product->category_id);
        return view('dashboard.admin.products.update',compact('htmlSelect','product','imagePro'));
    }


    public function update(ProductValidation $request)
    {
        try {
            DB::beginTransaction();

                $product = $this->product->find($request->id);
                $updateProduct = $request->except('filepath');
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
            return redirect()->route('list_product');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }
    }

 
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

