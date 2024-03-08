<?php

namespace App\Http\Controllers;

use App\Enums\StatusBill;
use Illuminate\Http\Request;
use App\Http\Controllers\APi\vnpay\Pay;
use App\Models\OrderModel;

class OrderController extends Controller
{
    private $pay;
  
    public function __construct(Pay $pay){
        $this->pay = $pay;
    }

    function index(){
        $this->pay->getBill();
        $order = [
        'status1'=> OrderModel::where('status' ,[0,1,2,3])->get(),
        'status2'=> OrderModel::where('status' ,[4,5])->get(),
        'status3'=> OrderModel::where('status' ,6)->get(),
        'status4'=> OrderModel::where('status' ,7)->get()
    ];
        $statusO = StatusBill::values();
        return view('dashboard.admin.bills.list',compact(['order',"statusO"]));

    }

    public function show(string $id){
        $oneOrder = OrderModel::with('order_detail.product.images')->find($id);
        $statusO = StatusBill::values();
        return view('dashboard.admin.bills.detail',compact(['oneOrder',"statusO"]));

    }


  
}
