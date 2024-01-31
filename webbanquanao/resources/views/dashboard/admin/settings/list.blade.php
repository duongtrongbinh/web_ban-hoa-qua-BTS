@extends('dashboard.layout.master')
@section('content')
<div class="mb-5">
    <div class="pagetitle">
      <h1>Setting</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Setting</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
</div>

    <section class="section contact">

      <div class="row gy-4">

          <div class="row">
            <div class="col-lg-6">
                <div class="info-box card">
                  <i class="bi bi-badge-cc"></i>
                  <h3>Name Company</h3>
                  <p>{{ $setting->name_company}}</p>
                </div>
              </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-geo-alt"></i>
                <h3>Address</h3>
                <p>{{ $setting->address}}</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-telephone"></i>
                <h3>Phone Company</h3>
                <p>{{ $setting->phone}}<br>{{ $setting->phone2}}</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card mb-2">
                <i class="bi bi-envelope"></i>
                <h3>Email Us</h3>
                <p>{{ $setting->email}}</p>
                <br>
              </div>
            </div>
          </div>
            <div class="text-center">
                <a href="{{ route('edit_setting',[1])}}"  class="div btn btn-primary">Edit</a href="">
            </div>
        </div>


    </section>

@endsection