@extends('dashboard.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/index.min.css')}}">
@endsection
@section('js')
<script src="{{ asset('admin/assets/vendor/select2/index.min.js')}}"></script>
<script>
    $('.select2_per').select2({
        'placeholder': "Vui lòng chọn vai trò."
    });
</script> 
@endsection
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">List Nhân viên</li>
        <li class="breadcrumb-item active">Add Nhân viên</li>
      </ol>
    </nav>
</div>

<form action="{{ route('add_user')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control mt-2" placeholder="Vui lòng nhập họ và tên của bạn." value="{{ old('name')}}">
                @if($errors->has('name'))
                <small id="helpId" class="text-danger">{{ $errors->first('name') }}</small>
                @endif
              </div>
              <div class="form-group mt-3">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control mt-2" placeholder="Vui lòng nhập email của bạn." value="{{ old('email')}}">
                  @if($errors->has('email'))
                  <small id="helpId" class="text-danger">{{ $errors->first('email') }}</small>
                  @endif
              </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>Vai trò</label>
                <select name="role[]" multiple class="form-control mt-2 select2_per">
                    <option value=""></option>
                    @foreach ($listRole as $item)
                    <option value="{{ $item->id}}">{{ $item->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('role'))
                <small id="helpId" class="text-danger">{{ $errors->first('role') }}</small>
                @endif
            </div>
            <div class="form-group mt-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control mt-2" placeholder="Vui lòng nhập số điện thoại bạn." value="{{ old('phone')}}">
                @if($errors->has('phone'))
                <small id="helpId" class="text-danger">{{ $errors->first('phone') }}</small>
                @endif
            </div>
        </div>
        
        <div class="form-group">
            <input type="hidden" name="filepath" class="form-control mt-2" value="abc.jpg">
            <input type="hidden" name="address" class="form-control mt-2" value="số 1 ngõ a ... ">
            <input type="hidden" name="birthday" class="form-control mt-2" value="2003-12-25">
            <input type="hidden" name="desc" class="form-control mt-2" value="xin chào.">
            <input type="hidden" name="password" class="form-control mt-2" value="123456789">
            <input type="hidden" name="ag" value="d">
          </div>
        <div class="col-12 text-center mt-3">
            <button type="submit" class="btn btn-primary">Add User</button>
        </div>
    </div>


</form>

@endsection