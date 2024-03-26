<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function orders(){
        $xx = session()->get('user');
        if($xx){
            $data= ['id'=>$xx['id']]; 
        $response = Http::withHeaders(['Authorization' => 'Bearer '.$xx['token'] ,])->post(env('API_URL').env('Orders'),$data);
        $order = $response->json();
        return view('pages.myaccount.orders',compact('order'));
        }
    }
    public function showOrder($id){
        $xx = session()->get('user');
        if($xx){ 
        $response = Http::withHeaders(['Authorization' => 'Bearer '.$xx['token'] ,])->post(env('API_URL').env('OrderDetail')."/".$id);
        $order_detail = $response->json();
        // dd($order_detail);
        return view('pages.myaccount.order_detail',compact('order_detail'));
        }
    }
}
