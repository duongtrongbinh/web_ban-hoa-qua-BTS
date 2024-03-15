
@extends('dashboard.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/index.min.css')}}">
<style>
  .icon{
    width: 30px;
    height: 60px;
  }

  .addBi::before{
    font-size: 20px !important;
    margin-top: 8px !important;
    margin-left: 5px !important;
    color: blue

  }
  .colorAdd{
    height: 37.6px;
  }
</style>
@endsection
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Add Product</li>
      </ol>
    </nav>
  </div>
  {{-- action="{{ route('add_product')}}" --}}
<div class="container-fuild">
  <div class="row">
    <form method="POST" action="{{ route('add_product')}}" enctype="multipart/form-data">  
      @csrf
        <div class="modal-body">
          
          <div class="row">     
            <div class="form-group col-4">
                <label for="" class="form-lable mb-2">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập name ..." value="{{ old('name') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group col-4">
                <label for="" class="form-lable mb-2">Quantity</label>
                <input type="number" name="quantity" class="form-control" placeholder="Nhập quantity ..." value="{{ old('quantity') }}">
                @if($errors->has('quantity'))
                <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
            </div>

            <div class="form-group col-4">
                <label for="" class="form-lable mb-2">Price</label>
                <input type="number" name="price" class="form-control" placeholder="Nhập price ..."  value="{{ old('price') }}">
                @if($errors->has('price'))
                <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
            </div>
          </div>
          <div class="row">
            <div class="form-group mt-2 col-4">
              <label class="form-lable mb-2">Select choose cateygory</label>
              <select class="form-select" name="category_id" value="{{ old('category_id') }}">
                <option value="" selected>Choose category</option>
                {{!! $htmlSelect !!}}
              </select>
              @if($errors->has('category_id'))
              <span class="text-danger">{{ $errors->first('category_id') }}</span>
              @endif
            </div>

            <div class="form-group mt-3 col-4">
              <label class="form-lable mb-2">Image</label>
              <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="hidden" name="filepath" >

            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
            
              @if($errors->has('filepath'))
              <span class="text-danger">{{ $errors->first('filepath') }}</span>
              @endif
            </div>

            <div class="form-group mt-2 col-4">
              <label class="form-lable mb-2">Select Status</label>
              <select class="form-select" name="status" >
                <option value="" selected>Choose status</option>
                @foreach ($productStatus as $value =>$key)
                  <option value="{{ $key}} " {{ old('status') == $key ? 'selected' : '' }}>{{ $value}}</option>
                @endforeach
              </select>
              @if($errors->has('status'))
              <span class="text-danger">{{ $errors->first('status') }}</span>
              @endif
            </div>
          </div>
          <div class="row">
              <div class="form-group col-3 mt-3">
                <label for="" class="form-lable mb-2">Height</label>
                <input type="text" name="height" class="form-control" placeholder="Nhập heights ..."  value="{{ old('height') }}">
                @if($errors->has('height'))
                <span class="text-danger">{{ $errors->first('height') }}</span>
                @endif
            </div>
            <div class="form-group col-3 mt-3">
                <label for="" class="form-lable mb-2">Weight</label>
                <input type="text" name="weight" class="form-control" placeholder="Nhập weight ..." value="{{ old('weight') }}">
                @if($errors->has('weight'))
                <span class="text-danger">{{ $errors->first('weight') }}</span>
                @endif
            </div>
            <div class="form-group col-3 mt-3">
                <label for="" class="form-lable mb-2">Length</label>
                <input type="text" name="length" class="form-control" placeholder="Nhập length ..." value="{{ old('length') }}">
                @if($errors->has('length'))
                <span class="text-danger">{{ $errors->first('length') }}</span>
                @endif
            </div>
            <div class="form-group col-3 mt-3">
              <label for="" class="form-lable mb-2">Width</label>
              <input type="text" name="width" class="form-control" placeholder="Nhập width ..." value="{{ old('width') }}">
              @if($errors->has('width'))
              <span class="text-danger">{{ $errors->first('width') }}</span>
              @endif
          </div>
          </div>
          <div class="form-group col mt-2">
            <label for="" class="form-lable mb-2">information content</label>
            <textarea class="form-control my-editor-tinymce4" name="content" placeholder="Nhập content ..." >{{ old('content') }}</textarea>
            @if($errors->has('content'))
            <span class="text-danger">{{ $errors->first('content') }}</span>
            @endif
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
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/select2/index.min.js')}}"></script> 
<script src="{{ asset('admin/assets/js/product/addProduct.js')}}"></script>
<script src="/path-to-your-tinymce/tinymce.min.js"></script>
@endsection
@endsection



