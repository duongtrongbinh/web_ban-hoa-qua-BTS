@extends('layouts.master')
@section('content')

<!-- dưới header có banner -->
    <!-- Hero Start -->
@include('mains.hero', ['slides' => $slides])
    <!-- Hero End -->

    <!-- Featurs Section Start -->
@include("mains.featurs")
    <!-- Featurs Section End -->

    <!-- products Shop Start-->
@include("mains.products",['products'=> $products])
    <!-- products Shop End-->

    <!-- Vesitable Shop Start-->
{{-- @include("mains.vesitable") --}}
    <!-- Vesitable Shop End -->

    <!-- Bestsaler Product Start -->
{{-- @include("mains.bestsaler") --}}
    <!-- Bestsaler Product End -->

    <!-- Fact Start -->
@include("mains.fact")
    <!-- Fact Start -->
@endsection
{{-- @section('js')
<script src="{{ asset('cart/cart.js')}}"></script>
@endsection --}}

