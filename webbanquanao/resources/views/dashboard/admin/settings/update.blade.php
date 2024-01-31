@extends('dashboard.layout.master')
@section('content')
<div class="mb-5">
    <div class="pagetitle">
      <h1>Setting</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Setting</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
</div>


<form action="{{ route('update_setting')}}" method="post">
    @method('PUT')
    @csrf
    <div class="row">
    <div class="col-6 mb-4">
        <div class="form-group">
            <input
            type="text"
            name="name_company"
            class="form-control"
            placeholder="Your Name"
            value="{{ $settingone->name_company}}"
            />
            <input type="hidden" name="id" value="{{ $settingone->id}}" class="form-control">
        </div>
    </div>

    <div class="col-6 mb-4">
        <div class="form-group">
            <input
            type="email"
            class="form-control"
            name="email"
            placeholder="Your Email"
            value="{{ $settingone->email}}"
            />
        </div>
    </div>

    <div class="col-6 mb-4">
        <div class="form-group">
            <input
            type="text"
            name="phone"
            class="form-control"
            placeholder="Your phone"
            value="{{ $settingone->phone}}"
            />
        </div>
    </div>

    <div class="col-6 mb-4">
        <div class="form-group">
            <input
            type="text"
            class="form-control"
            name="phone2"
            placeholder="Your phone 2"
            value="{{ $settingone->phone2}}"
            />
        </div>
    </div>
    <div class="col-12 mb-5">
        <div class="form-group">
            <input
            type="text"
            class="form-control"
            name="address"
            placeholder="Your address"
            value="{{ $settingone->address}}"
            />
        </div>
    </div>


    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
    </div>
</form>
@endsection