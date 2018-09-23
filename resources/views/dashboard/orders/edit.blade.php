@extends('layouts.dashboard')

@section('title','Edit a discount')

@section('stylesheets')
    {{ Html::style('assets/dashboard/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}
    <style>
        .datepicker-note {
            display: none !important;
        }
        .daterangepicker th, .datetimepicker th, .datepicker th {
            color: white;
        }
        .datepicker thead tr:first-child {
            background-color: #1fb5ac;
        }
        th.dow {
            color: #1fb5ac;
        }
    </style>
@stop

@section('scripts')
    {{ Html::script('assets/dashboard/plugins/daterangepicker/js/moment.min.js') }}
    {{ Html::script('assets/dashboard/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js') }}
    {{ Html::script('assets/dashboard/js/pages/discount.js') }}
@stop

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{route('dashboard.deal.index')}}">Discount</a>
    </li>
    <li class="active">
        <strong>Edit</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">

    <header class="panel_header">
        <h2 class="title pull-left">
            Edit discount
        </h2>
        <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
        <div class="row">
            {{ Form::open(['route'=>['dashboard.deal.update' , $resource->id] , 'method' => 'PATCH' , 'files' => TRUE]) }}
            <input type="hidden" name="resource_id" value="{{ $resource->id }}">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="product">
                        Product
                    </label>
                    <div class="controls">
                        {{ Form::select('product_id' , $products , $resource->product_id , ['id' => 'product' , 'class' => 'form-control']) }}
                    </div>
                    <p class="text-danger">{{ $errors->first('product_id') }}</p>
                </div>

                <div class="form-group">
                    <label>
                        Activation period (From : To)
                    </label>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="datetime-from" class="datetimepicker" data-default-date="{{ $resource->activation_start }}"></div>
                            <input type="hidden" name="activation_start" value="{{ $resource->activation_start }}">
                        </div>
                        <div class="col-md-6">
                            <div id="datetime-to" class="datetimepicker" data-default-date="{{ $resource->activation_end }}"></div>
                            <input type="hidden" name="activation_end" value="{{ $resource->activation_end }}">
                        </div>
                    </div>
                    <p class="text-danger">{{ $errors->first('activation_end') }}</p>
                    <p class="text-danger">{{ $errors->first('activation_start') }}</p>
                </div>

                <div class="form-group">
                    <label for="percentage">
                        Percentage
                    </label>
                    <div class="controls">
                        <input type="number" min=0 name="percentage" id="percentage" class="form-control" value="{{ $resource->percentage }}">
                    </div>
                    <p class="text-danger">{{ $errors->first('percentage') }}</p>
                </div>

                <div class="form-group">
                    <label for="active">
                        Is active :
                        <input type="checkbox" name="active" id="active" class="" value="1" {{ $resource->active === 1?"checked='checked'":'' }}>
                    </label>
                    <p class="text-danger">{{ $errors->first('active') }}</p>
                </div>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn">Reset</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</section>
@stop
