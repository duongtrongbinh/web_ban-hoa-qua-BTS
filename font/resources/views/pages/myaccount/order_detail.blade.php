<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @include('layouts.css')
</head>
<body>
    
<div class="container my-5  d-flex  justify-content-center">
    <div class="card card-1">
        <div class="card-header bg-white">
            <div class="media flex-sm-row flex-column-reverse justify-content-between  ">
                <div class="col my-auto"> <h4 class="mb-0">Thanks for your Order,<span class="change-color">{{$order_detail['name']}}</span> !</h4> </div>
                <div class="col-auto text-center  my-auto pl-0 pt-sm-4"><a href="{{ URL::previous() }}"><span>Quay lại</span></a></div>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-between mb-3">
                <div class="col-auto"> <h5 class="color-1 mb-0 change-color">Product</h5> </div>
            </div>
            @foreach ($order_detail['order_detail'] as $key=>$value)
            <div class="row">
                <div class="col">
                    <div class="card card-2">
                        <div class="card-body">
                            <div class="media">
                                <div class="sq align-self-center "> <img class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" src="{{ $value['product']['images'][0]['code_image']}}" width="135" height="135" /> </div>
                                <div class="media-body my-auto text-right">
                                    <div class="row  my-auto flex-column flex-md-row">
                                        <div class="col my-auto"> <h6 class="mb-0">{{$value['product']['name']}}</h6>  </div>
                                        <div class="col-auto my-auto"> <small>{{$value['quantity']}}</small></div>
                                        <div class="col my-auto"> <small>{{number_format($value['price'])}} d</small></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row mt-4">
                <div class="col">
                    <div class="row justify-content-between">
                        <div class="col-auto"><p class="mb-1 text-dark"><b>Order Details</b></p></div>
                        <div class="flex-sm-col text-right col"> <p class="mb-1"><b>Tổng tiền phụ:</b></p> </div>
                        <div class="flex-sm-col col-auto"> <p class="mb-1">{{number_format($order_detail['subtotal']) }} d</p> </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="flex-sm-col text-right col"><p class="mb-1"> <b>Phí vận chuyển:</b></p> </div>
                        <div class="flex-sm-col col-auto"><p class="mb-1">{{number_format($order_detail['moneyship'] )}} d</p></div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="flex-sm-col text-right col"><p class="mb-1"><b>Thuế VAT:</b></p></div>
                        <div class="flex-sm-col col-auto"><p class="mb-1">10 %</p></div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="flex-sm-col text-right col"><p class="mb-1"><b>Thanh toán:</b></p></div>
                        <div class="flex-sm-col col-auto"><p class="mb-1">{{number_format($order_detail['total']) }} d</p></div>
                    </div>
                </div>
            </div>
            <div class="row invoice ">
                <div class="col"><p class="mb-1"> Người nhận : {{$order_detail['name'] }}</p><p class="mb-1"> Số điện thoại : {{$order_detail['phone'] }}</p><p class="mb-1">Ngày đặt hàng : {{ date('Y-m-d', strtotime($order_detail['created_at'])) }} </p></div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-auto">
                                    @if ($order_detail['status'] == "0")
                                    <style>
                                        #tracker{
                                            width: 10%;
                                        }
                                    </style>
                                    @elseif ($order_detail['status'] == "2")
                                    <style>
                                        #tracker{
                                            width: 30%;
                                        }
                                    </style>
                                    @elseif ($order_detail['status'] == "3")
                                    <style>
                                        #tracker{
                                            width: 60%;
                                        }
                                    </style>
                                    @elseif ($order_detail['status'] == "4" || $order_detail['status'] == "5")
                                        <style>
                                            #tracker{
                                                width: 100%;
                                                }
                                        </style>
                                    @endif
                                    <div class="progress my-auto"> <div class="progress-bar progress-bar  rounded" id="tracker" role="progressbar" aria-valuenow="50" aria-valuemin="0"  aria-valuemax="100"></div> </div>
                                    @if ($order_detail['status'] == "7")
                                    <style>
                                        #tracker{
                                            width: 100%;
                                            }
                                    </style>
                                    <div class="media row justify-content-between ">
                                        <div class="col-auto text-right"><span> <small  class="text-right mr-sm-2">Đặt hàng</small> <i class="fa fa-circle active"></i> </span></div>
                                        <div class="col-auto flex-col-auto"><small  class="text-right mr-sm-2">Da Huy</small><span> <i  class="fa fa-circle"></i></span></div>
                                    </div>
                                    @else
                                    <div class="media row justify-content-between ">
                                        <div class="col-auto text-right"><span> <small  class="text-right mr-sm-2">Đặt hàng</small> <i class="fa fa-circle active"></i> </span></div>
                                        <div class="flex-col"> <span> <small class="text-right mr-sm-2">Vận chuyển</small><i class="fa fa-circle active"></i></span></div>
                                        <div class="col-auto flex-col-auto"><small  class="text-right mr-sm-2">Giao hàng</small><span> <i  class="fa fa-circle"></i></span></div>
                                        <div class="col-auto flex-col-auto"><small  class="text-right mr-sm-2">Thanh cong</small><span> <i  class="fa fa-circle"></i></span></div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                {{-- <div class="row justify-content-between ">
                    <div class="col-auto my-auto ml-auto"><h3 class="display-3 ">Total:</h3></div>
                    <div class="col-auto my-auto "><h2 class="mb-0 font-weight-bold">TOTAL PAID</h2></div>
                    <div class="col-auto my-auto ml-auto"><h3 class="display-3 ">5,528</h3></div>
                </div> --}}

        </div>
    </div>
</div>
</body>
</html>