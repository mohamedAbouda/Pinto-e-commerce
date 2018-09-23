@extends('layouts.dashboard.app')

@section('stylesheets')
{{ Html::style('assets/panel-assets/plugins/datetimepicker/jquery.datetimepicker.css') }}
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">
            {{ trans('web.dashboard_offers_pages_create_page_section_header_create_product_offer') }}
        </h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => 'dashboard.offers.store']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">
            {{ trans('web.dashboard_offers_pages_create_page_offer_info') }}.
        </h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="product_id">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_offers_pages_create_page_product') }}
            </label>
            {{ Form::select('product_id', $products , null ,['id'=>'product_id','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('product_id') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="percentage">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_offers_pages_create_page_percentage') }}
            </label>
            {{ Form::number('percentage', old('percentage',0) ,['id'=>'percentage','min'=>0,'required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('percentage') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="activation_start">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_offers_pages_create_page_activation_start') }}
            </label>
            {{ Form::text('activation_start', old('activation_start') ,['id'=>'activation_start','required'=>'required','class' => 'form-control' , 'placeholder' => 'YYYY-MM-DD HH:MM:SS']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('activation_start') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="activation_end">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_offers_pages_create_page_activation_end') }}
            </label>
            {{ Form::text('activation_end', old('activation_end') ,['id'=>'activation_end','required'=>'required','class' => 'form-control' , 'placeholder' => 'YYYY-MM-DD HH:MM:SS']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('activation_end') }}</p>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-1 col-xs-4">
        <button type="submit" class="btn primary-btn">
            {{ trans('web.dashboard_create_page_save_button') }}
        </button>
    </div>
    <div class="col-md-1 col-xs-4">
        <button type="reset" class="btn cancel-btn">
            {{ trans('web.dashboard_create_page_reset_button') }}
        </button>
    </div>
</div>
{{ Form::close() }}
@stop
@section('scripts')
{{ Html::script('assets/panel-assets/plugins/datetimepicker/build/jquery.datetimepicker.full.min.js') }}
<script type="text/javascript">
$(document).ready(function(){
    $('#activation_start').datetimepicker({
        format:'Y-m-d H:i:s'
    });
    $('#activation_end').datetimepicker({
        format:'Y-m-d H:i:s'
    });


});

</script>
@stop
