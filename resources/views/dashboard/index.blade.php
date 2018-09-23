@extends('layouts.dashboard')

@section('title','Dashboard')

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="r4_counter db_box">
                <i class="pull-left fa fa-bar-chart icon-md icon-rounded icon-primary"></i>
                <div class="stats">
                    <h4><strong># {{ $redeemed_gifts->where('type','discount')->count() }}</strong></h4>
                    <span>Discounts used</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="r4_counter db_box">
                <i class="pull-left fa fa-bar-chart icon-md icon-rounded icon-orange"></i>
                <div class="stats">
                    <h4><strong># {{ $redeemed_gifts->where('type','gift_card')->count() }}</strong></h4>
                    <span>Gift cards used</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="r4_counter db_box">
                <i class="pull-left fa fa-bar-chart icon-md icon-rounded icon-purple"></i>
                <div class="stats">
                    <h4><strong># {{ $redeemed_gifts->where('type','coupon')->count() }}</strong></h4>
                    <span>Coupons used</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="box ">

    <header class="panel_header">
        <h2 class="title pull-left">Dashboard</h2>
        <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <!-- ********************************************** -->



                <!-- ********************************************** -->

            </div>
        </div>
    </div>
</section>
@stop
