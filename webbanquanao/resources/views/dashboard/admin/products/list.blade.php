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
        <li class="breadcrumb-item active">Product</li>
      </ol>
    </nav>
  </div>


<div class="card">
    <div class="card-body">
      <h5 class="card-title">List product</h5>

      <!-- Table with stripped rows -->
      <table class="table table-striped text-center">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($product as $item)
          @php $count++;@endphp
            <tr>
              <td>{{ $count}}</td>
              <td>{{ $item->code}}</td>
              <td>{{ $item->name}}</td>
              <td>{{ $item->categoryP->name}}</td>
              <td>{{ $item->quantity}}</td>
              <td>{{ $item->price}}</td>
              <td>
                  <a href="{{ route('edit_product',[$item->id])}}" class="btn btn-success bt-3" >
                    Edit
                  </a>
                  <a href="" data-url="{{ route('delete_product',[$item->id])}}" class="btn btn-warning deleteProduct">Delete</a>
              </td>
          </tr>
          @endforeach


        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
  </div>
@endsection





