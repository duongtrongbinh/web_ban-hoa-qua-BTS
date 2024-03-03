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

class Pay extends Controller
{

    public function medium1(Request $request){
        $data = $request->post();
        if($data['data1']['TT'] == 'VNPAYQR'){
            $order_code = $this->apiOrderGhn($request->post());
            $xx = $this->saveDb($request->post(),$order_code);
            if($xx == true){
                $url = $this->billVNpay($request->post(),$request);
                return response()->json($url, 200);
            }
            return response()->json(false, 200);
     
            
        }else{
            $order_code = $this->apiOrderGhn($request->post());
            $xx = $this->saveDb($request->post(),$order_code);
            if($xx == true){
                $url ="http://localhost:4200";
                return response()->json($url, 200); 
            }
            return response()->json(false, 200);
   
        }

    }
    public function pay_return(Request $request){
      
        return redirect()->away('http://localhost:4200');
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

    public function billVNpay($data,$data1){
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
            "vnp_OrderInfo" =>$vnp_TxnRef,
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
}

