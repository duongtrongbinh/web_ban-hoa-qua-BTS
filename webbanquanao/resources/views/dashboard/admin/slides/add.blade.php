@extends('dashboard.layout.master')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">Slide</li>
        <li class="breadcrumb-item active">Add Slide</li>
      </ol>
    </nav>
</div>
<form method="POST" action="{{ route('add_slide')}}" enctype="multipart/form-data">  
    @csrf
        <div class="row">
            <div class="form-group col-4">
                <label for="" class="form-lable mb-2">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập name ..." value="{{ old('title')}}">
                @if($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group col-4">
                <label for="" class="form-lable mb-2">Description</label>
                <input type="text" name="description" class="form-control" placeholder="Nhập description ..." value="{{ old('description')}}">
                @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group col-4">
                <label for="" class="form-lable mb-2">Select Category</label>
                <select class="form-select" name="category_id" >
                    <option value='' selected>Choose...</option>
                        {{!! $htmlSelect !!}}
                  </select>
                  @if($errors->has('category_id'))
                  <span class="text-danger">{{ $errors->first('category_id') }}</span>
                  @endif
            </div>
        </div>
        <div class="form-group mt-2">
            <label class="form-lable mb-2">Image</label>
            <div class="input-group">
              <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                  <i class="fa fa-picture-o"></i> Choose
                </a>
              </span>
              <input id="thumbnail" class="form-control" type="hidden" name="filepath" value="{{ old('filepath')}}">

          </div>
          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          
            @if($errors->has('filepath'))
            <span class="text-danger">{{ $errors->first('filepath') }}</span>
            @endif
        </div>
      <div class="d-flex text-center mt-5 ">
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="reset" class="btn btn-success">Reset</button>
      </div>
</form>
@section('js')
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('admin/assets/js/product/addProduct.js')}}"></script>
<script src="/path-to-your-tinymce/tinymce.min.js"></script>
@endsection
@endsection