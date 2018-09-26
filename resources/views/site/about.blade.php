@extends('layouts.site.app')

@section('content')
<div class="hero-section v3">
    <img src="{{ asset('assets/site/img/about/about_simple_bg.jpg') }}" alt="" class="img-responsive">
    <div class="box-center">
        <h1 class="page-title">About Us</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="">About Us</a></li>
        </ul>
    </div>
</div>
<!--our teams-->
<div class="container">
    <div class="about-shop-ver1"  style="padding-top: 90px;">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 shop-content">
                <h3 class="brand-title">THE BRAND</h3>
                <h2 class="agency-title-noline ver3">{{ $about->about_header }}</h2>
                <p>
                    {{ $about->description }}
                </p>
                <div class="shop-social">
                    <a href="{{ $contact_details && $contact_details->twitter ? $contact_details->twitter : '#' }}" title="twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="{{ $contact_details && $contact_details->facebook ? $contact_details->facebook : '#' }}" title="facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="{{ $contact_details && $contact_details->instagram ? $contact_details->instagram : '#' }}" title="instagram">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="{{ $contact_details && $contact_details->google ? $contact_details->google : '#' }}" title="google">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="cosre-bg text-center">
                    <img src="{{ $about->brand_image ? $about->brand_image_url : asset('assets/site/img/detail/MeUndies_SS17-1309_M-mb.png') }}" alt="">
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 50px;">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="cosre-bg text-center">
                    <img src="{{ $about->mission_images ? $about->mission_image_url : asset('assets/site/img/detail/01_img.png') }}" alt="">
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 shop-content">
                <h3 class="brand-title">Our Mission</h3>
                <h2 class="agency-title-noline ver3">{{ $about->mission_header }}</h2>
                <p>{{ $about->mission_description }}</p>
            </div>
        </div>
    </div>
</div>
@stop
