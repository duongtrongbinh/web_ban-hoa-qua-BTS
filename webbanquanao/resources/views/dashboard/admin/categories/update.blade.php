@extends('dashboard.layout.master')
@section('content')
<form method="POST" action="{{ route('update_categories')}}">  
    @csrf
    @method("PUT")
        <div class="form-group">
            <label for="" class="form-lable mb-2">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập name ..." value="{{ $oneCategory->name}}">
            <input type="hidden" name="id" class="form-control" placeholder="Nhập name ..." value="{{ $oneCategory->id}}">
            @if($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group mt-2">
            <label for="" class="form-lable mb-2">Select Parent Folder</label>
            <select class="form-select" name="parent_id">
                    {{!! $htmlSelect !!}}
              </select>
            @if($errors->has('parent_id'))
              <span class="text-danger">{{ $errors->first('parent_id') }}</span>
              @endif
        </div>
      <div class="d-flex text-center mt-5 ">
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="reset" class="btn btn-success">Reset</button>
      </div>
</form>
@endsection