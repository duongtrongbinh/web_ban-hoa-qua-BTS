@extends('layouts.master')
@section('content')
        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
          <h1 class="text-center text-white display-6">My Order</h1>
          <ol class="breadcrumb justify-content-center mb-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active text-white">My Order</li>
          </ol>
      </div>
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button
                  class="nav-link"
                  data-bs-toggle="tab"
                  data-bs-target="#profile-orders"
                >
                  Đơn hàng ({{ count($order['order']['status1'])}})
    
                </button>
              </li>
    
              <li class="nav-item">
                <button
                  class="nav-link"
                  data-bs-toggle="tab"
                  data-bs-target="#profile-order-success"
                >
                  Đã hoàn tất ({{count($order['order']['status2'])}})
                </button>
              </li>
    
              <li class="nav-item">
                <button
                  class="nav-link"
                  data-bs-toggle="tab"
                  data-bs-target="#profile-order-cancel"
                >
                  Đơn hủy ({{count($order['order']['status4'])}})
                </button>
              </li>
    
              <li class="nav-item">
                <button
                  class="nav-link"
                  data-bs-toggle="tab"
                  data-bs-target="#profile-order-return"
                >
                  Trả hàng ({{count($order['order']['status3'])}})
                </button>
              </li>
    
            </ul>
            <div class="tab-content pt-2">
              <div class="tab-pane fade pt-3" id="profile-orders">
                    <!-- Profile order Form -->
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title">Đơn hàng</h5>
    
                            <!-- Table with stripped rows -->
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Mã đơn</th>
                                    <th scope="col">Bên nhận</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Hình thức thanh toán</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody> 
                                @foreach ($order['order']['status1'] as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1}}</th>
                                            <td>{{ $item['code']}}</td>
                                            <td>
                                                <div class="container">
                                                    <h6>{{ $item['name']}}</h6>
                                                    <h6>{{ $item['phone']}}</h6>
                                                    <h6>{{ $item['address']}}</h6>
                                                    <h6>ngày tạo:{{ date('Y-m-d', strtotime($item['created_at'])) }}</h6>
                                                </div>
                                            </td>
                                            <td>{{ number_format($item['total'], 0, ',', '.')}} VND</td>
                                            <td>{{ $item['payment_id'] == 1 ? "Thanh toán vnpay" : "Thanh toán khi nhận hàng";}}</td>
                                            @foreach ($order['statusO'] as $index => $statusLabel)
                                                @if ($index == $item['status'])
                                                    <td> {{ $statusLabel }}</td>
                                                @endif
                                            @endforeach
                                            <td>
                                            {{-- @can('update', App\Models\CategoriesModel::class)   --}}
                                                <a  href="{{ route('detail_order',[$item['id']])}}" class="btn btn-success" selected>Detail</a>
                                            {{-- @endcan --}}
                                            {{-- @can('delete', App\Models\CategoriesModel::class) --}}
                                                {{-- <a data-url="{{ route('detail_order',[$item['id']])}}" class="btn btn-warning deleteCategory">Delete</a> --}}
                                            {{-- @endcan --}}
                                            </td>
                                        </tr>
                                @endforeach
    
                                
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
    
                            </div>
                        </div>
                    <!-- End Profile order Form -->
              </div>
    
              <div class="tab-pane fade pt-3" id="profile-order-success">
                <!-- profile success Form -->
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Đơn hàng</h5>
    
                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã đơn</th>
                            <th scope="col">Bên nhận</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Hình thức thanh toán</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody> 
                        @foreach ($order['order']['status2'] as $item)
    
    
                                <tr>
                                    <th scope="row">{{ $loop->index + 1}}</th>
                                    <td>{{ $item['code']}}</td>
                                    <td>
                                        <div class="container">
                                            <h6>{{ $item['name']}}</h6>
                                            <h6>{{ $item['phone']}}</h6>
                                            <h6>{{ $item['address']}}</h6>
                                            <h6>ngày tạo:{{ date('Y-m-d', strtotime($item['created_at'])) }}</h6>
                                        </div>
                                    </td>
                                    <td>{{ number_format($item['total'], 0, ',', '.')}} VND</td>
                                    <td>{{ $item['payment_id'] == 1 ? "Thanh toán vnpay" : "Thanh toán khi nhận hàng";}}</td>
                                    @foreach ($order['statusO'] as $index => $statusLabel)
                                        @if ($index == $item['status'])
                                            <td> {{ $statusLabel }}</td>
                                        @endif
                                    <td>
                                    @endforeach
    
                                    {{-- @can('update', App\Models\CategoriesModel::class)   --}}
                                        <a  href="{{ route('detail_order',[$item['id']])}}" class="btn btn-success" selected>Detail</a>
                                    {{-- @endcan --}}
                                    {{-- @can('delete', App\Models\CategoriesModel::class) --}}
                                        {{-- <a data-url="{{ route('detail_order',[$item['id']])}}" class="btn btn-warning deleteCategory">Delete</a> --}}
                                    {{-- @endcan --}}
                                    </td>
                                </tr>
     
                            @endforeach
                        
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
    
                    </div>
                </div>
                <!-- End profile success Form -->
              </div>
    
              <div class="tab-pane fade pt-3" id="profile-order-cancel">
                <!-- profile cancel Form -->
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Đơn hàng</h5>
    
                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã đơn</th>
                            <th scope="col">Bên nhận</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Hình thức thanh toán</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody> 
                        @foreach ($order['order']['status4'] as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1}}</th>
                                    <td>{{ $item['code']}}</td>
                                    <td>
                                        <div class="container">
                                            <h6>{{ $item['name']}}</h6>
                                            <h6>{{ $item['phone']}}</h6>
                                            <h6>{{ $item['address']}}</h6>
                                            <h6>ngày tạo:{{ date('Y-m-d', strtotime($item['created_at'])) }}</h6>
                                        </div>
                                    </td>
                                    <td>{{ number_format($item['total'], 0, ',', '.')}} VND</td>
                                    <td>{{ $item['payment_id'] == 1 ? "Thanh toán vnpay" : "Thanh toán khi nhận hàng";}}</td>
                                    @foreach ($order['statusO'] as $index => $statusLabel)
                                        @if ($index == $item['status'])
                                            <td> {{ $statusLabel }}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                    {{-- @can('update', App\Models\CategoriesModel::class)   --}}
                                        <a  href="{{ route('detail_order',[$item['id']])}}" class="btn btn-success" selected>Detail</a>
                                    {{-- @endcan --}}
                                    {{-- @can('delete', App\Models\CategoriesModel::class) --}}
                                        {{-- <a data-url="{{ route('detail_order',[$item['id']])}}" class="btn btn-warning deleteCategory">Delete</a> --}}
                                    {{-- @endcan --}}
                                    </td>
                                </tr>
        
                            @endforeach
    
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
    
                    </div>
                </div>
                <!-- End profile cancel Form -->
    
                
              </div>
    
              <div class="tab-pane fade pt-3" id="profile-order-return">
                <!-- profile success Form -->
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Đơn hàng</h5>
    
                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã đơn</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody> 
                        @foreach ($order['order']['status3'] as $item)
    
    
                                <tr>
                                    <th scope="row">{{ $loop->index + 1}}</th>
                                    <td>{{ $item['code']}}</td>
                                    <td>{{ number_format($item['total'], 0, ',', '.')}} VND</td>
                                    <td>{{ $item['payment_id'] == 1 ? "Thanh toán vnpay" : "Thanh toán khi nhận hàng";}}</td>
                                    @foreach ($order['statusO'] as $index => $statusLabel)
                                        @if ($index == $item['status'])
                                            <td> {{ $statusLabel }}</td>
                                        @endif
                                    <td>
                                    @endforeach
    
                                    {{-- @can('update', App\Models\CategoriesModel::class)   --}}
                                        <a  href="{{ route('detail_order',[$item['id']])}}" class="btn btn-success" selected>Detail</a>
                                    {{-- @endcan --}}
                                    {{-- @can('delete', App\Models\CategoriesModel::class) --}}
                                        {{-- <a data-url="{{ route('detail_order',[$item['id']])}}" class="btn btn-warning deleteCategory">Delete</a> --}}
                                    {{-- @endcan --}}
                                    </td>
                                </tr>
     
                            @endforeach
                        
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
    
                    </div>
                </div>
                <!-- End profile success Form -->
              </div>
            </div>
            <!-- End Bordered Tabs -->
          </div>
        </div>
    </div>
@endsection
