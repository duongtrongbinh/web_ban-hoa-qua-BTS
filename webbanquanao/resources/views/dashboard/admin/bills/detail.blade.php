@extends('dashboard.layout.master')
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin/assets/js/deleteAll/delete.js') }}"></script>
@endsection
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Order Detail</li>
      </ol>
    </nav>
</div>

                <div class="card ml-5">

                    <div class="card-body mt-5">
                            
                            <h3 class="modal-title">Chi tiết đơn hàng</h3>


                            <div class="row">
                            <div class="col-lg-3 col-md-4 label">
                                Mã đơn
                            </div>
                            <div class="col-lg-9 col-md-8">
                                {{ $oneOrder->code }}
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-lg-3 col-md-4 label">
                                Ngày mua hàng:
                            </div>
                            <div class="col-lg-9 col-md-8">
                                {{
                                $oneOrder->created_at
                                }}
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-lg-3 col-md-4 label">
                                Người nhận:
                            </div>
                            <div class="col-lg-9 col-md-8">
                                {{ $oneOrder->name }}
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-lg-3 col-md-4 label">
                                Số điện thoại:
                            </div>
                            <div class="col-lg-9 col-md-8">
                                {{ $oneOrder->phone }}
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-lg-3 col-md-4 label">
                                Địa chỉ:
                            </div>
                            <div class="col-lg-9 col-md-8">
                                {{ $oneOrder->address }}
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-lg-3 col-md-4 label">
                                Thanh toán:
                            </div>
                            <div class="col-lg-9 col-md-8">
                                {{ $oneOrder->payment_id == 1 ? "Thanh toán vnpay" : "Thanh toán khi nhận hàng";}}
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-lg-3 col-md-4 label">
                                Trạng thái:
                            </div>
                            <div class="col-lg-9 col-md-8">
                                @foreach ($statusO as $index => $statusLabel)
                                @if ($index == $oneOrder->status)
                                    {{ $statusLabel }}
                                @endif
                            @endforeach
                            </div>
                            </div>
                        

                        <h3 class="mt-3 mb-3">
                            Sản phẩm ({{ count($oneOrder->order_detail) }})
                            </h3>
               
                        @foreach ($oneOrder->order_detail as $detail)
                            <div class="d-flex justify-content-around">
                                <div class="label">{{ $detail->product->name }}</div>
                                <div class=" label">{{ $detail->quantity }}</div>
                                <div class="label">{{ number_format(($detail->quantity * $detail->price), 0, ',', '.')}}  VND</div>
                            </div>
                        @endforeach


                        <h3 class="mt-3 mb-3">
                            Vận chuyển
                            </h3>

                        @php
                            $result = array_slice($statusO, 0, $oneOrder->status);
                        @endphp
                        <div class="d-flex">
                            @foreach ($result as $item)
                                <h5>{{ $item }}</h5>
                            @endforeach

                        </div>
                    </div>

                </div>

                

@endsection
