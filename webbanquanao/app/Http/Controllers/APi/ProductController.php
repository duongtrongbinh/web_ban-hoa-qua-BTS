<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\ImageProduct;

class ProductController extends Controller
{
    protected $product;
    protected $image;
    public function __construct() {
        $this->product = new ProductModel();
        $this->image = new ImageProduct();
    }

    public function show(string $id)
    {
        $product = ProductModel::with('images')->find($id);
        if ($product) {
            // Bạn có thể sử dụng dữ liệu của bản ghi ở đây
        return response()->json($product);
        } else {
            return response()->json(['message' => 'Bản ghi không tồn tại'], 404);
        }

    }


    public function index()
    {
        $products = ProductModel::with('images')->paginate(15);
        return response()->json($products);
    }


    public function addCart(string $id,$quantity){
        $product = ProductModel::with('images')->find($id);
        $cart = array();
        if(isset($cart['id'])){
            $cart[$id]['quantity'] += $quantity;
        }else{
            $cart[$id] = [
                'name'=>$product->name,
                'price'=>$product->price,
                'quantity'=>1,
                'code_image'=>$product->images
            ];
        }
        session()->put('cart', $cart);
        $xx = session()->get('cart');
        return response()->json($xx);
    }
}
