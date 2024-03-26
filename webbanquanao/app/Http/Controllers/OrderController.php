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
        'status1'=> OrderModel::where('status' ,[0,1,2,3])->paginate(30),
        'status2'=> OrderModel::where('status' ,[4,5])->paginate(30),
        'status3'=> OrderModel::where('status' ,6)->paginate(30),
        'status4'=> OrderModel::where('status' ,7)->paginate(30)
    ];
        $statusO = StatusBill::values();
        return view('dashboard.admin.bills.list',compact(['order',"statusO"]));

    }

    public function show(string $id){
        $oneOrder = OrderModel::with('order_detail.product.images')->find($id);
        $statusO = StatusBill::values();
        $this->pay->StatusOrderB($oneOrder->code);
        if($oneOrder->status == 7){
            $result = [
                StatusBill::status1,
                StatusBill::status8
            ];
        }else if($oneOrder->status == 0){
            $result = [StatusBill::status1];
        }else{
            $result = array_slice($statusO, 0, $oneOrder->status);
        }
        
        return view('dashboard.admin.bills.detail',compact(['oneOrder',"result","statusO"]));

    }


  
}
