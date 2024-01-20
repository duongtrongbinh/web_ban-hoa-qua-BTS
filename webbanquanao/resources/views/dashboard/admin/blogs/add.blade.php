
@extends('dashboard.layout.master')
{{-- @section('css')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/index.min.css')}}">
@endsection --}}
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Add Blog</li>
      </ol>
    </nav>
  </div>
<div class="container-fuild">
  <div class="row">
    <form method="POST" action="{{ route('add_blog')}}" enctype="multipart/form-data">  
      @csrf
        <div class="modal-body">
        <div class="form-group mt-3">
            <label for="" class="form-lable mb-2">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Nhập title ..." >
        </div>

        <div class="form-group mt-3">
            <label class="form-lable mb-2">Image</label>
            <input type="file" name="code" class="form-control">
        </div>

          <div class="form-group col mt-2">
            <label for="" class="form-lable mb-2">Content</label>
            <textarea class="form-control my-editor-tinymce4" name="content" placeholder="Nhập content ..."></textarea>
          </div>

        </div>
        <div class="mt-5 text-center">
          <button type="submit" class="btn btn-primary">Add</button>
          <button type="reset" class="btn btn-outline-warning">Reset</button>
        </div>
  </form>
  </div>
</div>
@section('js')
{{-- <script src="{{ asset('admin/assets/vendor/select2/index.min.js')}}"></script>  --}}
<script src="{{ asset('admin/assets/js/product/addProduct.js')}}"></script>
<script src="/path-to-your-tinymce/tinymce.min.js"></script>
@endsection
@endsection



