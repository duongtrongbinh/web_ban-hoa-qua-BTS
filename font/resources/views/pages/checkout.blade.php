@extends('layouts.master')
@section('content') 
        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Checkout</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Checkout</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Checkout Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Billing details</h1>
                <form action="{{ route('order')}}" method="POST">
                    @csrf
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-6 col-xl-7">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Họ và tên<sup>*</sup></label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name')}}">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Số điện thoại<sup>*</sup></label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone')}}">
                                        @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Tỉnh/ thành phố<sup>*</sup></label>
                                        <select name="province" class="form-select">
                                            <option value="">Choose</option>
                                            @foreach ($provin as $province)
                                            <option value="{{ $province['ProvinceID']}}:{{ $province['ProvinceName']}}">{{ $province['ProvinceName']}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('province'))
                                        <span class="text-danger">{{ $errors->first('province') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Quận/ Huyện<sup>*</sup></label>
                                        <select name="district" class="form-select" disabled>
                                            <option value=""></option>
                                        </select>
                                        @if ($errors->has('district'))
                                        <span class="text-danger">{{ $errors->first('district') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Thị trấn/ xã<sup>*</sup></label>
                                        <select name="warn" class="form-select" disabled>
                                            <option value=""></option>
                                        </select>
                                        @if ($errors->has('warn'))
                                        <span class="text-danger">{{ $errors->first('warn') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
            
                            <div class="form-item">
                                <label class="form-label my-3">Address <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="House Number Street Name" name="address" value="{{ old('address')}}">
                                @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Ghi chú</label>
                                <input type="text" class="form-control" name="note" value="không có.">
                            </div>
                        
                
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="table-responsive">
                                <table class="table">

                                    <tbody>
                                        @foreach ($cartP as $cart)
                                        <tr >
                                            <td scope="row">
                                            <div class="d-flex align-items-center mt-2">
                                            <img src="{{ $cart['images'][0]['code_image'] }}" class="img-fluid" style="width: 90px; height: 90px;" alt="">
                                            </div>
                                            </td>
                                            <td> 
                                            <div>{{ $cart['name'] }}</div>
                                            <div class="row mt-2">
                                            <div class="col-8">{{ number_format($cart['price'])}} đ</div>
                                            <div class="col-4">
                                            <input type="number" style="width:40px;border:0;text-align:center;" value="{{ $cart['quantity'] }}" min="1">
                                            </div>
                                            </div>
                                            </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="py-5" colspan="1">
                                                <p class="mb-0 text-dark text-uppercase py-3">Dự tính</p>
                                                <p class="mb-0 text-dark text-uppercase py-3">Tiền Ship</p>
                                                <p class="mb-0 text-dark text-uppercase py-3">Tổng tiền</p>
                                            </td>
                                            <td class="py-5" colspan="2">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark" id="subTo">{{ number_format($subtol)}} đ</p>
                                                </div>
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark" id="moneyship">0 đ</p>
                                                </div>
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark" id="payMent">{{ number_format($subtol)}} đ</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" id="Delivery-1" name="TT" value="TM">
                                        <label class="form-check-label" for="Delivery-1">Thanh toán vnpay</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" id="Paypal-1" name="TT" value="VNPAYQR">
                                        <label class="form-check-label" for="Paypal-1">Paypal</label>
                                    </div>
                                </div>
                                @if ($errors->has('pay'))
                                    <div class="col-12">
                                        <span class="text-danger">{{ $errors->first('pay') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Checkout Page End -->
@section('js')
<script src="{{ asset('cart\bill.js') }}"></script>
<script>
    
    var district = "{{ route('district', ':productId') }}";
    var warn = "{{ route('warn', ':districtId') }}";
    var moneyship = "{{ route('moneyship', ':id') }}";


</script>
@endsection
@endsection

