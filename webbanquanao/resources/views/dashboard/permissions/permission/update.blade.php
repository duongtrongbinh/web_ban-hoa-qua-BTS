@extends('dashboard.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/index.min.css')}}">
@endsection
@section('js')
<script src="{{ asset('admin/assets/vendor/select2/index.min.js')}}"></script>
<script>
    $('.checkbot_x').on('click', function (){
         $(this).parents('.card').find(".check_ii").prop('checked', $(this).prop('checked'));
    });
</script> 
@endsection
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Add Role</li>
      </ol>
    </nav>
</div>

<form action="{{ route('update_role',[$role->id])}}" method="post">
    @csrf
    @method("PUT")
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Tên vai trò</label>
                <input type="text" name="name" class="form-control mt-2" placeholder="Vui lòng nhập tên vai trò." value="{{ $role->name}}">
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
              </div>
              <div class="form-group mt-3">
                  <label>Mô tả vai trò</label>
                  <input type="text" name="display_name" class="form-control mt-2" placeholder="Vui lòng nhập mô tả vai trò của bạn." value="{{ $role->display_name}}">
                  {{-- <small id="helpId" class="text-muted">Help text</small> --}}
              </div>
        </div>
        <div class="col-12 mt-5">
            <h4 class="mb-2">
                Permission
            </h4>
            @foreach ($permission as $item)

            <div class="card">
                <div class="card-header" style="background: #0D6EFD">
                    <div class="form-check">
                        <input class="form-check-input checkbot_x" type="checkbox" >
                        <h5 class="text-dark">{{ $item->name}}</h5>
                      </div>
                </div>

                <div class="card-body d-flex justify-content-between mt-3">
                    @foreach ($item->permissions as $value)
                    <div class="div">
                        <div class="form-check">
                            <input class="form-check-input check_ii" type="checkbox" {{ $rolePer->contains('id',$value->id) ? "checked" : "" }} value="{{ $value->id}}" name="permisson[]">
                            <label class="form-check-label" >
                              {{ $value->name}}
                            </label>
                          </div>
                    </div>
                    @endforeach
                </div>
            </div>
                            
            @endforeach
        </div>
        <div class="col-12 mt-3 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
@endsection