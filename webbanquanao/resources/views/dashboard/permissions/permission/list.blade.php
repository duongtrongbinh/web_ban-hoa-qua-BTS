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
        <li class="breadcrumb-item active">List Role</li>
      </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
      <h5 class="card-title">List Role</h5>
      <div class="d-flex justify-content-end mt-2 mb-2">
        <a style="margin-right: 5px" href="{{ route('form_add_role')}}" class="btn btn-primary mb-3 bt-3" >
            Add Role
          </a>
          <a href="{{ route('form_add_permiison')}}" class="btn btn-primary mb-3 bt-3" >
            Add Permisson
          </a>
        </div>
      <!-- Table with stripped rows -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody> 
          @php $count=0; @endphp
          @foreach ($role as $item)
          @php $count++; @endphp
         
          <tr>
            <th scope="row">{{ $count}}</th>
            <td>{{ $item->name}}</td>
            <td>
                {{ $item->display_name}}
            </td>
            <td class="d-flex">
                <a href="{{ route('edit_role',[$item->id])}}" class="btn btn-success" style="margin-right: 5px">Edit</a>
                <a data-url="{{ route('delete_role',[$item->id])}}" class="btn btn-warning deleteRole">Delete</a>
            </td>
            @endforeach
          </tr>
        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
</div>
@endsection