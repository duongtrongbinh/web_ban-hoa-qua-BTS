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
        <li class="breadcrumb-item active">Blog</li>
      </ol>
    </nav>
</div>


<div class="card">
    <div class="card-body">
      <h5 class="card-title">List Blog</h5>
      <!-- Table with stripped rows -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Image Blog</th>
            <th scope="col">User</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody> 
          @php $count=0; @endphp
          @foreach ($listBlog as $item)
          @php $count++; @endphp
         
          <tr>
            <th scope="row">{{ $count}}</th>
            <td><h3>{{ $item->title}}</h3></td>
            <td><img width="200px" height="auto" src="{{ $item->code_image}}" alt="{{ $item->name_image}}"></td>
            <td>{{$item->userB->name}}</td>
            <td class="d-flex ">
                <a href="{{ route('edit_blog',[$item->id])}}" class="btn btn-success" style="margin-right: 10px">Edit</a>
                <a data-url="{{ route('delete_blog',[$item->id])}}" class="btn btn-warning deleteBlog">Delete</a>
            </td>
            @endforeach
          </tr>
        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
</div>
@endsection
