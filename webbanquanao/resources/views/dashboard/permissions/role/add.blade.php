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
                <input type="text" name="name" class="form-control mt-2" placeholder="Vui lòng nhập họ và tên của bạn.">
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
              </div>
              <div class="form-group mt-3">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control mt-2" placeholder="Vui lòng nhập email của bạn.">
                  {{-- <small id="helpId" class="text-muted">Help text</small> --}}
              </div>
        </div>
        <div class="col-6 ">
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control mt-2" placeholder="Vui lòng nhập địa chỉ của bạn.">
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
              </div>
              <div class="form-group mt-3">
                  <label>Birthday</label>
                  <input type="date" name="birthday" class="form-control mt-2">
                  {{-- <small id="helpId" class="text-muted">Help text</small> --}}
              </div>
        </div>
        <div class="col-12">
            <div class="form-group mt-3">
                <label>Giới thiệu bản thân</label>
                <textarea type="text" name="desc" class="form-control mt-2" placeholder="Vui lòng giới thiệu bản thân bạn."></textarea>
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
              </div>
        </div>
        <div class="col-6">
            <div class="form-group mt-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control mt-2" placeholder="Vui lòng nhập mật khẩu của bạn.">
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
              </div>

        </div>
        <div class="col-6">
            <div class="form-group mt-3">
                <label>Nhập ảnh đại diện</label>
                <input type="file" name="image_avatar" class="form-control mt-2">
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group mt-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control mt-2" placeholder="Vui lòng nhập số điện thoại bạn.">
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
            </div>
        </div>
        <div class="col-12 mt-3">

            <div class="form-group">
                <label>Vai trò</label>
                <select name="role[]" multiple class="form-control mt-2 select2_per">
                    <option value=""></option>
                    @foreach ($listRole as $item)
                    <option value="{{ $item->id}}">{{ $item->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 text-center mt-3">
            <button type="submit" class="btn btn-primary">Add User</button>
        </div>
    </div>


</form>

@endsection