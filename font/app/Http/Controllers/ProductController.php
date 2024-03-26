<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    private $products;
    private $districts;
    private $warn;
    private $header;
    private $headersder;
    private $subtotal;
    public function __construct(){
        $this->header =[
            'Content-Type'=>'application/json',
            'token'=>'d4d4cd6f-8f70-11ee-96dc-de6f804954c9'
        ];
          $this->headersder =[
            'Content-Type'=>'application/json',
            'token'=>'d4d4cd6f-8f70-11ee-96dc-de6f804954c9',
            'ShopId'=>'4734816'
          ];
        $response = Http::get(env('API_URL').'/'.'productShop');
        $this->products = $response->json();
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        $response = Http::get(env('API_URL').'/'.'productShop'.'?page='.$page);
        $products = $response->json();
        // dd($products['links']);
        return view('pages.product',compact(['products']));
    }
    public function addToCart($id,$quantity){
  
        $response1 = Http::get(env('API_URL').'/'.'product/'.$id);
        $product = $response1->json();
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            $cart[$id]['quantity'] += $quantity;
        }else{
            $cart[$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'images' => $product['images'], // Lấy các ảnh của sản phẩm dưới dạng mảng
            ];
        }

        session()->put('cart', $cart);
        $cartPro = session()->get('cart');
        return response()->json($cartPro, 200);

    }

    public function decrease($id){
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity'] -= 1;
            session()->put('cart', $cart);
            $cartPro = session()->get('cart');
            return response()->json($cartPro, 200);
        }
    }
    public function sumCart(){
        $totalPrice =$this->sum();
        // dd($totalPrice);
        return response()->json($totalPrice, 200);
    }


    public function mycart(){
        $carts = session()->get('cart');
        return view('pages.cart',compact('carts'));
    }
    public function showCart()
    {
        // Lấy dữ liệu giỏ hàng từ session hoặc database
        $cartItems = session()->get('cart');
        $html = '';

        if(count($cartItems) <1){
            $html .= '<tr>';
            $html .= '<td scope="row">';
            $html .= 'Bạn chưa chọn sản phẩm nào.';        
            $html .= '</td>';
            $html .= '</tr>';
            $html .='<style>';
            $html .='#tt{display: none;}';
            $html .='</style>';
        }else{
        // Tạo chuỗi HTML JSON
        if (!empty($cartItems)) {
            foreach ($cartItems as $product) {
                $html .= '<tr class="cart'. $product['id'] . '">';
                // Cột ảnh
                $html .= '<td scope="row">';
                $html .= '<div class="d-flex align-items-center mt-2">';
                $html .= '<img src="' . $product['images'][0]['code_image'] . '" class="img-fluid" style="width: 90px; height: 90px;" alt="">';
                $html .= '</div>';
                $html .= '</td>';
                // Cột tên, giá và số lượng
                $html .= '<td ';
                $html .= '<div>' . $product['name'] . '</div>';
                $html .= '<div class="row mt-2">';
                $html .= '<div class="col-8">' . number_format($product['price']) .'VND'. '</div>';
                $html .= '<div class="col-4">';
                $html .= '<button class="btn btn-sm btn-secondary change-quantity" data-type="increase" data-url="' . route('cart', [$product['id'],1]) . '">+</button>';
                $html .= '<input type="number" style="width:40px;border:0;text-align:center;" class="quantity-input" value="' . $product['quantity'] . '" min="1">';
                $html .= '<button class="btn btn-sm btn-secondary change-quantity" data-type="decrease" data-url="' . route('decreaseCart', $product['id']) . '" >-</button>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</td>';
                // Cột Xóa
                $html .= '<td class="d-flex align-items-center"><i class="fas fa-times" onclick="removeProduct(' . $product['id'] . ')"></i></td>';
                $html .= '</tr>';
            
            }
        }
        }
        return response()->json(['html' => $html]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function removeCart($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            session()->forget('cart.' .$id);
            $cartP = session()->get('cart');
            return response()->json($cartP, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     */
    public function sum(){
        $totalPrice = 0;

        if(session()->has('cart')) {
        $cartItems = session()->get('cart');
        
        foreach ($cartItems as $product) {
            $quantity = $product['quantity'];
            $price = $product['price'];
            $totalPrice += $quantity * $price;
        }
        }
        return $totalPrice;
    }
    public function getCheckoutCartProvince()
    {
        $response1 = Http::withHeaders($this->header)->get(env('UrlProvince'));
        $province = $response1->json();
        $user =session()->get('user');
        if(isset($user)) {

        $cartP = session()->get('cart');
        $provin = array_reverse(($province)['data']);
        $subtol =$this->sum();
        return view('pages.checkout', compact('cartP','provin','subtol'));
        }else{
            return view('errors.cart_login');
        }
    }
    public function getDistrict($province){
    $provinceData = explode(':', $province);
    $provinceId = $provinceData[0];

        $response1 = Http::withHeaders($this->header)->post(env('UrlDistrict'), [
            'province_id' => intval($provinceId)
        ]);
        $distri = $response1->json();
        return response()->json(($distri)['data'],200);

    }
    public function getWarn($district){
        // dd();
        $provinceData = explode(':', $district);
        $districtId = $provinceData[0];
        $response1 = Http::withHeaders($this->header)->post(env('UrlWard'), [
            'district_id' => intval($districtId)
        ]);
        $dc = intval($districtId);
        session()->put('dis', $dc);
        $this->warn = $response1->json();
        session('money', ($this->warn)['data']);
        return response()->json(($this->warn)['data'],200);

    }
    public function moneyShip($warn){
        $provinceData = explode(':', $warn);
        $warnCode = $provinceData[0];
        $data=[
        "service_type_id"=>2,
        "from_district_id"=>0,
        "to_district_id"=>session()->get('dis'),
        "to_ward_code"=>"$warnCode",
        "height"=>10,
        "length"=>10,
        "weight"=>1000,
        "width"=>10,
        "insurance_value"=>$this->sum(),
        "coupon"=> null,
        ];
        session()->put("valueGHN", $data);
        $response1 = Http::withHeaders($this->headersder)->post(env('UrlShip'), $data);
        $money = ($response1->json());
        session()->forget('dis');
        session()->put('moneyship', $money);
        return response()->json($money,200);
    }

    /**
     * Display the specified resource.
     */
    public function orderSS(ProductRequest $request){
    $data1 =$this->addRess($request);

    $data3 = session()->get('cart'); // Lấy giá trị của 'cart' từ session

  $objects = $this->items($data3);
    $data =[
        'data1'=>$data1,
        'data3'=>$objects,
        'data'=>session()->get('valueGHN'),
    ];
    $xx = session()->get('user');
    $response1 = Http::withHeaders(['Authorization' => 'Bearer '.$xx['token'] ,])->post(env('API_URL').env('Bill'), $data);
    $returnData = $response1->json();
    session()->forget('cart');
    return redirect()->away($returnData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function addRess($request)
    {
        $ud = session()->get('user');
        $selectedProvince = request('province');
        $selectedDistrict = request('district');
        $selectedWarn = request('warn');
        
        $provinceData = explode(':', $selectedProvince);
        $districtData = explode(':', $selectedDistrict);
        $warnData = explode(':', $selectedWarn);
        $mon = session()->get('moneyship');
        
        $request->merge([
            'provinceId' => $provinceData[0],
            'provinceName' => $provinceData[1],
            'districtId' => $districtData[0],
            'districtName' => $districtData[1],
            'warnId' => $warnData[0],
            'wardName' => $warnData[1],
            'user_id'=>$ud['id'],
            'moneyship'=>$mon['data']['total'],
        ]); // Tách giá trị thành provinceId và provinceName
        $addressA = implode(', ', [$request->address, $warnData[1], $districtData[1],$provinceData[1]]);
        $data = $request->merge([
            'addressA' => $addressA
        ]);
        return $data->all();
    }

    public function items($CART){
    // Khởi tạo một mảng rỗng để chứa dữ liệu mới
    $jsonArray = [];

    // Lặp qua mỗi phần tử trong mảng session
    foreach ($CART as $id => $product) {
    // Tạo một mảng mới chứa thông tin sản phẩm
    $productArray = [
        'id' => $id,
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' =>  intval($product['quantity'])
    ];

    // Thêm mảng sản phẩm này vào mảng JSON
    $jsonArray[] = $productArray;
    }
    return $jsonArray;
}

    public function show(string $id){
        $response = Http::get(env('API_URL').'/'.'product'."/". $id);
        $product = $response->json();
        return view('pages.product_detail',compact('product'));
    }

}
