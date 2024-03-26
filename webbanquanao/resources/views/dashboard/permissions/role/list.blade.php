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
        <li class="breadcrumb-item active">List Nhân viên</li>
      </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
      <h5 class="card-title">List nhân viên</h5>
      <div class="d-flex justify-content-end mt-2 mb-2">
        @can('add-user')
        <a href="{{ route('form_add_user')}}" class="btn btn-primary mb-3 bt-3" >
          Add Nhan vien 
        </a>
        @endcan
        </div>
      <!-- Table with stripped rows -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Quyền</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody> 
          @php $count=0; @endphp
          @foreach ($listUser as $item)
          @php $count++; @endphp
         
          <tr>
            <th scope="row">{{ $count}}</th>
            <td>{{ $item->name}}</td>
            <td>{{ $item->email}}</td>
            <td>{{ $item->phone}}</td>
            <td>
              @foreach ($item->roles as $key)
                {{$key->name}}
              @endforeach
            </td>
            <td>
              @can("edit-user")
                <a href="{{ route('edit_user',[$item->id])}}" class="btn btn-success">Edit</a>
              @endcan
              @can('delete-user')
                <a data-url="{{ route('delete_user',[$item->id])}}" class="btn btn-warning deleteUser">Delete</a>
              @endcan
            </td>
            @endforeach
          </tr>
        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
</div>
@endsection