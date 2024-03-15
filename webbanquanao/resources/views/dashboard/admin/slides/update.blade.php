@extends('dashboard.layout.master')
@section('content')
<form method="POST" action="{{ route('update_slide',[$slide->id])}}" enctype="multipart/form-data">  
    @csrf
    @method('PUT')
        <div class="row">
            <div class="form-group col-4">
                <label for="" class="form-lable mb-2">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập title ..." value="{{ $slide->title}}">
            </div>
            <div class="form-group col-4">
                <label for="" class="form-lable mb-2">Description</label>
                <input type="text" name="desc" class="form-control" placeholder="Nhập description ..." value="{{ $slide->desc}}">
            </div>
            <div class="form-group col-4">
                    <label for="" class="form-lable mb-2">Select Category</label>
                    <select class="form-select" name="category_id" >
                        <option value='' selected>Choose...</option>
                            {{!! $htmlSelect !!}}
                      </select>
            </div>
        </div>
        <div class="row mt-2">
        <div class="form-group col-6">
            <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="hidden" name="filepath" value="abc">
  
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
        
        </div>
        <div class="form-group col-6">
            <img width="150px" height="auto" src="{{ $slide->code_image}}" alt="{{ $slide->name_image}}">
        </div>
    </div>
      <div class="d-flex text-center mt-5 ">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-success">Reset</button>
      </div>
</form>
@section('js')
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('admin/assets/js/product/addProduct.js')}}"></script>
<script src="/path-to-your-tinymce/tinymce.min.js"></script>
@endsection
@endsection