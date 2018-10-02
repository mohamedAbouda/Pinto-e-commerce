@extends('layouts.site.app')

@section('content')
<div class="hero-section v3">
    <img src="{{ asset('assets/site/img/about/about_simple_bg.jpg') }}" alt="" class="img-responsive">
    <div class="box-center">
        <h1 class="page-title">Privacy Policy</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ route('web.policy') }}">Privacy Policy</a></li>
        </ul>
    </div>
</div>
<!--our teams-->
<div class="container">
    <h2 class="faq-title text-center">
        {{ $policy ? $policy->description : '' }}
    </h2>
    <div class="faq js-faq">
        @foreach($policy_faq as $faq)
        <div class="faq-content">
            <a href="" onClick="return false;" class="faq-quest">
                {{ $faq->question }}
            </a>
            <span class="plus js-plus-icon"></span>
            <div class="faq-answer">
                <p>
                    {{ $faq->answer }}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@stop
