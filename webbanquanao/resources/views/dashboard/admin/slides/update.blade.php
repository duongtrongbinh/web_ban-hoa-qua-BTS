@extends('dashboard.layout.master')
@section('content')
<form method="POST" action="{{ route('update_slide',[$slide->id])}}" enctype="multipart/form-data">  
    @csrf
    @method('PUT')
        <div class="row">
            <div class="form-group col-6">
                <label for="" class="form-lable mb-2">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập title ..." value="{{ $slide->title}}">
            </div>
            <div class="form-group col-6">
                <label for="" class="form-lable mb-2">Description</label>
                <input type="text" name="desc" class="form-control" placeholder="Nhập description ..." value="{{ $slide->desc}}">
            </div>
        </div>
        <div class="row mt-2">
        <div class="form-group col-6">
            <label for="" class="form-lable mb-2">Image Slide</label>
            <input type="file" name="code_image" class="form-control" >
        </div>
        <div class="form-group col-6">
            <input type="hidden" name="code_image1" value="{{ $slide->name_image}}">
            <img width="150px" height="auto" src="{{ $slide->code_image}}" alt="{{ $slide->name_image}}">
        </div>
    </div>
      <div class="d-flex text-center mt-5 ">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-success">Reset</button>
      </div>
</form>
@endsection