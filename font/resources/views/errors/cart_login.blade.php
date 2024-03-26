@extends('layouts.master')
@section('content')
<!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Checkout</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Checkout</li>
            </ol>
        </div>
        <!-- Single Page Header End -->

                        <!-- cart login Start -->
                        <div class="container-fluid py-5">
                            <div class="container py-5 text-center">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        {{-- <i class="bi bi-exclamation-triangle display-1 text-secondary"></i> --}}
                                        <h1 class="display-1">Login</h1>
                                        <h1 class="mb-4">Login to use checkout</h1>
                                        <a class="btn border-secondary rounded-pill py-3 px-5" href="{{ route('login')}}">Go Back To Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- cart login End -->
@endsection