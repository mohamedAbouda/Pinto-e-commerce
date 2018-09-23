@extends('layouts.dashboard')

@section('title','Payment method data')

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{route('dashboard.payment_methods.index')}}">Payment Methods</a>
    </li>
    <li class="active">
        <strong>Edit</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">
    <header class="panel_header">
        <h2 class="title pull-left">{{ $resource->name }}</h2>
    </header>

    <div class="content-body">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                {{ Form::open(['route' => 'dashboard.payment_methods.update']) }}
                    @if($resource->name === 'PayPal')
                    <div class="form-group">
                        <label for="paypal_client_id">
                            Paypal client-id
                        </label>
                        {{ Form::text('paypal_client_id' , old('paypal_client_id' , $resource->paypal_client_id) , ['required' => 'required' , 'id' => 'paypal_client_id' , 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label for="paypal_client_secret">
                            Paypal client-secret
                        </label>
                        {{ Form::text('paypal_client_secret' , old('paypal_client_secret' , $resource->paypal_client_secret) , ['required' => 'required' , 'id' => 'paypal_client_secret' , 'class' => 'form-control']) }}
                    </div>
                    @else
                    <div class="form-group">
                        <label for="payfort_secret_key">
                            Payfort VISA secret-key
                        </label>
                        {{ Form::text('payfort_secret_key' , old('payfort_secret_key' , $resource->payfort_secret_key) , ['required' => 'required' , 'id' => 'payfort_secret_key' , 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label for="payfort_open_key">
                            Payfort VISA open-key
                        </label>
                        {{ Form::text('payfort_open_key' , old('payfort_open_key' , $resource->payfort_open_key) , ['required' => 'required' , 'id' => 'payfort_open_key' , 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label for="payfort_currency">
                            Payfort VISA default currency
                        </label>
                        {{ Form::text('payfort_currency' , old('payfort_currency' , $resource->payfort_currency) , ['required' => 'required' , 'id' => 'payfort_currency' , 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label for="payfort_customer_email">
                            Payfort VISA default customer email
                        </label>
                        {{ Form::email('payfort_customer_email' , old('payfort_customer_email' , $resource->payfort_customer_email) , ['required' => 'required' , 'id' => 'payfort_customer_email' , 'class' => 'form-control']) }}
                    </div>
                    @endif
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-default">
                            Reset
                        </button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@stop
