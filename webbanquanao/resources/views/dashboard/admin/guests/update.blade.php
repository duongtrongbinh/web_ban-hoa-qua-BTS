@extends('dashboard.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/index.min.css')}}">
@endsection
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">List Khách hàng</li>
        <li class="breadcrumb-item active">Update Khách hàng</li>
      </ol>
    </nav>
</div>

<form action="{{ route('update_user',[$user->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control mt-2" placeholder="Vui lòng nhập họ và tên của bạn." value="{{ $user->name}}">
                <input type="hidden" name="password" class="form-control mt-2"  value="{{ $user->password}}">
                @if($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
              <div class="form-group mt-3">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control mt-2" placeholder="Vui lòng nhập email của bạn." value="{{ $user->email}}">
                  @if($errors->has('email'))
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
              </div>
        </div>
        <div class="col-6 ">
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control mt-2" placeholder="Vui lòng nhập địa chỉ của bạn." value="{{ $user->address}}">
                @if($errors->has('address'))
                <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
              </div>
            
            <div class="form-group mt-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control mt-2" placeholder="Vui lòng nhập số điện thoại bạn." value="{{ $user->phone}}">
                    @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
            
        </div>
        <div class="col-12">
            <div class="form-group mt-3">
                <label>Giới thiệu bản thân</label>
                <textarea type="text" name="desc" class="form-control mt-2" placeholder="Vui lòng giới thiệu bản thân bạn.">{{ $user->desc}}</textarea>
                @if($errors->has('desc'))
                <span class="text-danger">{{ $errors->first('desc') }}</span>
                @endif
              </div>
        </div>

        <div class="col-6">
            <div class="form-group mt-3">
                <label class="form-lable mb-2">Ảnh đại diện</label>
                <div class="input-group">
                  <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                      <i class="fa fa-picture-o"></i> Choose
                    </a>
                  </span>
                  <input id="thumbnail" class="form-control" type="hidden" name="filepath" value="{{ $user->image_avatar}}">
    
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
              
                @if($errors->has('filepath'))
                <span class="text-danger">{{ $errors->first('filepath') }}</span>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group mt-3 text-center">
                <img src="{{ $user->image_avatar}}" alt="{{ $user->name_avatar}}" width="300px" height="250px">
                <input type="hidden" name="role" value="3">
                <input type="hidden" name="ag" value="g">
            </div>
        </div>
        {{-- <div class="col-12 mt-3"> --}}

            {{-- <div class="form-group">
                <label>Vai trò</label>
                <select name="role[]" multiple class="form-control mt-2 select2_per" >
                    @foreach ($listRole as $item)
                            <option value="{{ $item->id}}" {{ $roleOfUser->contains('id',$item->id) ? "selected" : "" }}>{{ $item->name}}</option>
                    @endforeach
                </select>
            </div> --}}
        {{-- </div> --}}
        <div class="col-12 text-center mt-3">
            <button type="submit" class="btn btn-primary">Update User</button>
        </div>
    </div>


</form>
@section('js')
<script src="{{ asset('admin/assets/vendor/select2/index.min.js')}}"></script>
<script>
    $('.select2_per').select2({
        'placeholder': "Vui lòng chọn vai trò."
    });
</script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('admin/assets/js/product/addProduct.js')}}"></script>
<script src="/path-to-your-tinymce/tinymce.min.js"></script>
@endsection
@endsection