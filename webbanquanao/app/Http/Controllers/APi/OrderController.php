<?php

namespace App\Http\Controllers\APi;

use App\Enums\StatusBill;
use App\Http\Controllers\APi\vnpay\Pay;
use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    

    function showOrderDetail($id){
        $data = OrderModel::find($id);
        $data->load('order_detail.product.images');
        return response()->json($data,200);

    }
}
