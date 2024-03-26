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
        $product = ProductModel::find($id);
        $product->load('images');
        if ($product) {
            // Bạn có thể sử dụng dữ liệu của bản ghi ở đây
        return response()->json($product);
        } else {
            return response()->json(['message' => 'Bản ghi không tồn tại'], 404);
        }

    }


    public function index()
    {
        $products = ProductModel::paginate(8);
        $products->load('images');
        return response()->json($products);
    }
    public function shop()
    {
        $products = ProductModel::paginate(15);
        $products->load('images');
        return response()->json($products);
    }


}
