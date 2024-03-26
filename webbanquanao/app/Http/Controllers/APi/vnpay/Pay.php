<?php

namespace App\Http\Controllers\APi\vnpay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Enums\StatusBill;
use App\Jobs\SendOrderConfirmationEmailJob;
use App\Mail\OrderConfirmationEmail;
use Illuminate\Support\Facades\Mail;

class Pay extends Controller
{
    private $url;
    private $statusB;
    public function construct(){
        $this->url = env("url_font");
        $this->statusB  = StatusBill::values();

    }

    public function medium1(Request $request){
        $data = $request->post();
        
        if($data['data1']['TT'] == 'VNPAYQR'){
            $order_code = $this->apiOrderGhn($request->post());
            $xx = $this->saveDb($request->post(),$order_code);
            if($xx == true){
                if($this->updateQuantityOrder($order_code,$signal = 1)){

                $url = $this->billVNpay($request->post(),$request,$order_code);
                return response()->json($url, 200);
            }
            return response()->json(false, 200);
        }
     
            
        }else{
            $order_code = $this->apiOrderGhn($request->post());

            $xx = $this->saveDb($request->post(),$order_code);
            if($xx == true){
                if($this->updateQuantityOrder($order_code,$signal = 1)){
                    $data = OrderModel::where('code',$order_code)->first();
                    dispatch(new SendOrderConfirmationEmailJob($data,auth()->user()->email));
                    return response()->json(env('url_font'), 200);
                }
 
            }
            return response()->json(false, 200);
   
        }

    }


    public function pay_return(Request $request){
        $dd = $request->input('vnp_ResponseCode');
        $code = $request->input('vnp_OrderInfo');
        if($dd == "00" ){
                return redirect()->away(env('url_font'));
            
        }else{
            $re = $this->updateQuantityOrder($code,$signal = "huy");
            if($re){
                $headers = [
                    'Content-Type'=>'application/json',
                    'ShopId'=>"4734816",
                    'token'=>'d4d4cd6f-8f70-11ee-96dc-de6f804954c9'
                ];
                $data = [
                    "order_codes"=>["$code"]
                ];
                
                $response = Http::withHeaders($headers)->post("https://online-gateway.ghn.vn/shiip/public-api/v2/switch-status/cancel", $data);
                if ($response->successful()) {
                    // Xử lý phản hồi khi request thành công
                    $responseData = $response->json();
                    $data = OrderModel::where('code',$code)->first();
                    dispatch(new SendOrderConfirmationEmailJob($data,auth()->user()->email));
                    return redirect()->away(env('url_font_return'));
    
                } else {
                    // Xử lý phản hồi khi request không thành công
                return redirect()->away(env('url_font_return'));
                }
            }

        }
    }


    public function saveDb($data,$code){

                $jsonData = [
                'user_id'=> $data['data1']['user_id'],
                'code'=>$code,
                'subtotal'=>$data['data']['insurance_value'],
                'moneyship'=>$data['data1']['moneyship'],
                'total'=>$data['data']['insurance_value'] + $data['data1']['moneyship'],
                'status'=> 0,
                'end_date'=>date('YmdHis'),
                'name'=>$data['data1']['name'],
                'phone'=>$data['data1']['phone'],
                'address'=>$data['data1']['addressA']
            ];
            if($data['data1']['TT'] == 'VNPAYQR'){
                $jsonData["payment_id"]=1;
            }else{
                $jsonData["payment_id"]=2;
            }
            $order = OrderModel::create($jsonData);
            if(isset($order)){
                foreach ($data['data3'] as $key) {
                    OrderDetailModel::create([
                        "order_id"=>$order->id,
                        'product_id'=>$key['id'],
                        'quantity'=>$key['quantity'],
                        'price'=>$key['price']
                    ]);
                }

                return true;
            }
            return false;

    }

    public function billVNpay($data,$data1,$order_code){
        $vnp_TxnRef = rand(1,10000); //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $data['data1']['moneyship'] + $data['data']['insurance_value']; // Số tiền thanh toán
        $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = ''; //Mã phương thức thanh toán
        $vnp_IpAddr = $data1->ip(); //IP Khách hàng thanh toán
        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
        $vnp_HashSecret = env('vnp_HashSecret');
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => env('vnp_TmnCode'),
            "vnp_Amount" => $vnp_Amount* 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" =>$order_code,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" =>env('APP_URL') . env('vnp_Returnurl'),
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = env('vnp_Url');
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return $vnp_Url;
    }

    public function apiOrderGhn($data){
        $apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create';

        $jsonData = [
            "note"=> $data['data1']['note'],
            "required_note"=> "KHONGCHOXEMHANG",
            "client_order_code"=> "",
            "to_name"=> $data['data1']['name'],
            "to_phone"=> $data['data1']['phone'],
            "to_address"=> $data['data1']['addressA'],
            "to_ward_name"=> $data['data1']['wardName'],
            "to_district_name"=> $data['data1']['districtName'],
            "to_province_name"=> $data['data1']['provinceName'],
            "content"=> "",
            "weight"=> $data['data']['weight'],
            "length"=> $data['data']['length'],
            "width"=> $data['data']['width'],
            "height"=> $data['data']['height'],
            "cod_failed_amount"=> 0,                  
            "pick_station_id"=> null,
            "deliver_station_id"=> null,
            "insurance_value"=> $data['data']['insurance_value'],
            "service_id"=> 0,
            "service_type_id"=> 2,
            "coupon"=> null,
            "pickup_time"=> Carbon::now()->timestamp,
            "pick_shift"=> [2],
            'items'=>$data['data3']
        ];
        if($data['data1']['TT'] == 'VNPAYQR'){
            $jsonData["payment_type_id"]=1;
            $jsonData["cod_amount"]=0;
        }else{
            $jsonData["payment_type_id"]=2;
            $jsonData["cod_amount"]=$data['data']['insurance_value'];
        }
        
        // Gửi POST request với dữ liệu
        // ::withHeaders($headers)->
        $headers = [
            'Content-Type'=>'application/json',
            'ShopId'=>"4734816",
            'token'=>'d4d4cd6f-8f70-11ee-96dc-de6f804954c9'
        ];

        $response = Http::withHeaders($headers)->post($apiUrl, $jsonData);
        // Xử lý phản hồi

        if ($response->successful()) {
            // Xử lý phản hồi khi request thành công
            $responseData = $response->json();
            $orderCode = $responseData['data']['order_code'];
    
            return $orderCode;
        } else {
            // Xử lý phản hồi khi request không thành công
            $errorCode = $response->status();
            return $errorCode;
        }
    }

    public function ShowOrder(Request $request){
        
        $data = OrderModel::where('user_id', $request->id)->get();
        // dd($request->id);
        $order = [
            'status1' => $data->filter(function ($item) {
                return in_array($item->status, [0, 1, 2, 3]);
            }),
            'status2' => $data->filter(function ($item) {
                return in_array($item->status, [4, 5]);
            }),
            'status3' => $data->filter(function ($item) {
                return $item->status == 6;
            }),
            'status4' => $data->filter(function ($item) {
                return $item->status == 7;
            })
        ];
        
            $statusO = StatusBill::values();
            $data1 = [
                'order'=>$order,
                'statusO'=>$statusO
            ];
            return response()->json($data1,200);
            // return response()->json(['order','statusO'],200);
    }

    public function updateQuantityOrder($code,$signal){
        $orderId = (OrderModel::where("code",$code)->first())->id;
        $orderDetails = OrderDetailModel::where('order_id', $orderId)->get();

    if ($orderDetails->isEmpty()) {
        return false;
    }
    if($signal == 'huy'){
                // Duyệt qua từng chi tiết đơn hàng để cập nhật kho
        foreach ($orderDetails as $orderDetail) {
            $newQuantity = $orderDetail->product->quantity + $orderDetail->quantity;
            $orderDetail->product->update(['quantity' => $newQuantity]);
        }

        // Xóa các chi tiết đơn hàng và đánh dấu đơn hàng là đã hủy
        OrderDetailModel::where('order_id', $orderId)->delete();
        OrderModel::where('id', $orderId)->delete();
        return true;

    }else{
            // Duyệt qua từng chi tiết đơn hàng để cập nhật kho
            foreach ($orderDetails as $orderDetail) {
                $updateQuantity = $orderDetail->product->quantity - $orderDetail->quantity;
                $orderDetail->product->update(['quantity' => $updateQuantity]);
            }
            return true;
    }

    }



    public function getBill(){
        $data = OrderModel::get();
        return true;
    }


    public function StatusOrderB($code){
        $headers = [
            'Content-Type'=>'application/json',
            'token'=>'d4d4cd6f-8f70-11ee-96dc-de6f804954c9'
        ];
        $data = [
            "order_code"=>$code
        ];
        
        $response = Http::withHeaders($headers)->post("https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/detail", $data);
        
        if ($response->successful()) {
            $responseData = $response->json();
            $lastLog = end($responseData['data']['log']);
            $status = $lastLog['status'];
            switch ($status) {
                case 'picking':
                case 'ready_to_pick':
                case 'money_collect_picking':
                    OrderModel::where('code', $code)->update(['status' => 0]);
                    break;
                case 'picked':
                    OrderModel::where('code', $code)->update(['status' => 1]);
                    break;
                case 'transporting':
                case 'sorting':
                    OrderModel::where('code', $code)->update(['status' => 2]);
                    break;
                case 'delivering':
                case 'money_collect_delivering':
                    OrderModel::where('code', $code)->update(['status' => 3]);
                    break;
                case 'delivered':
                    OrderModel::where('code', $code)->update(['status' => 4]);
                    break;
                case 'delivery_fail':
                    OrderModel::where('code', $code)->update(['status' => 5]);
                    break;
                case 'waiting_to_return':
                    OrderModel::where('code', $code)->update(['status' => 6]);
                    break;
                case 'cancel':
                    OrderModel::where('code', $code)->update(['status' => 7]);
                    break;
                default:
                    OrderModel::where('code', $code)->update(['status' => 7]);
                    break;
            }
            return true;

        } else {
            return "lôi";
        }
    }

}

