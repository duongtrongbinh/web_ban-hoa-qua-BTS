@extends('dashboard.layout.master')
@section('content')
<form method="POST" action="{{ route('add_permiison')}}">  
    @csrf
        <div class="form-group">
            <label for="" class="form-lable mb-2">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập name ...">
        </div>
        <div class="form-group mt-2">
            <label for="" class="form-lable mb-2">Select Parent Folder</label>
            <select class="form-select" name="parent_id">
                <option value='0' selected>Choose...</option>
                    {{!! $htmlSelect !!}}
              </select>
        </div>
      <div class="d-flex text-center mt-5 ">
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="reset" class="btn btn-success">Reset</button>
      </div>
</form>
@endsection