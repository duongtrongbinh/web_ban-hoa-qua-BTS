@extends('dashboard.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/datatable/index.min.css') }}" />
@endsection
@section('content')
<div class="pagetitle">
    <div class="d-flex" style="justify-content: space-between">
      <h1>Dashboard</h1>
      <div>
        <a class="btn btn-outline-success pr-3" href="{{ route('export_list_product') }}">Import</a>  
        <a class="btn btn-outline-success pr-3" href="{{ route('export_list_product') }}">Export</a>  
      </div>
    </div>
    <nav >
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item active">List Product</li>
      </ol>
    </nav>
  </div>

<div class="card">
    <div class="card-body mt-5">

      <!-- Table with stripped rows -->
      <table class="table table-striped datatableProduct" >
        <thead>
          <tr>
            <th scope="col">#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $key =>$value)
          <tr>
            <td>{{$key +1}}</td>
            <td>{{ $value->name}}</td>
            <td>{{ $value->category_name}}</td>
            <td>{{ $value->quantity}}</td>
            <td>{{ number_format($value->price)}}</td>
            <td>
              <a href='{{ route("edit_product",$value->id)}}' class='btn btn-success btn-sm' style='margin-right: 5px'>Edit</a>
              <a data-url='{{ route("delete_product",$value->id)}}' class='btn btn-danger btn-sm deleteProduct'>Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tbody>
        </tbody>
      </table>
      <!-- End Table with stripped rows -->
      {{ $data->links()}}
    </div>
  </div>
@endsection
@section('js')
<script src="{{ asset('admin/assets/vendor/datatable/index.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin/assets/js/deleteAll/delete.js') }}"></script>
{{-- <script>
  $(function () {
    // $.fn.dataTable.ext.errMode = 'throw';
    let table = $('.datatableProduct').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("list_product") }}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'category_name', name: 'category'},
            {data: 'quantity', name: 'quantity'},
            {data: 'price', name: 'price'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script> --}}
@endsection





