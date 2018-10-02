@extends('layouts.site.app')

@section('content')
<div class="hero-section v3">
    <img src="{{ asset('assets/site/img/about/about_simple_bg.jpg') }}" alt="" class="img-responsive">
    <div class="box-center">
        <h1 class="page-title">Shipping & return policy</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ route('web.shipping') }}">Shipping & return policy</a></li>
        </ul>
    </div>
</div>
<!--our teams-->
<div class="container">
    <h2 class="faq-title text-center">
        {!! $shipping ? $shipping->shipping_and_return : '' !!}
    </h2>
  
</div>
@stop
