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
                <input type="text" name="title" class="form-control" placeholder="Nhập name ...">
            </div>
            <div class="form-group col-4">
                <label for="" class="form-lable mb-2">Description</label>
                <input type="text" name="description" class="form-control" placeholder="Nhập description ...">
            </div>
            <div class="form-group col-4">
                <label for="" class="form-lable mb-2">Select Category</label>
                <select class="form-select" name="category_id">
                    <option value='0' selected>Choose...</option>
                        {{!! $htmlSelect !!}}
                  </select>
            </div>
        </div>
        <div class="form-group mt-2">
            <label for="" class="form-lable mb-2">Image Slide</label>
            <input type="file" name="code_image" class="form-control">
        </div>
      <div class="d-flex text-center mt-5 ">
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="reset" class="btn btn-success">Reset</button>
      </div>
</form>
@endsection