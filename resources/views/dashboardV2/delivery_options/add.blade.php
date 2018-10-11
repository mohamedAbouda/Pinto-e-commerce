@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">
            {{ trans('web.dashboard_delivery_option_pages_create_page_section_header_add_delivery_option') }}
        </h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => 'dashboard.delivery_options.store']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">
            {{ trans('web.dashboard_delivery_option_pages_create_page_delivery_option_info') }}.
        </h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_delivery_option_pages_create_page_name') }}
            </label>
            {{ Form::text('name',old('name'),['id'=>'name','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('name') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="email">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_delivery_option_pages_create_page_price') }}
            </label>
            {{ Form::number('cost',old('cost',0),['id'=>'cost','min'=>0,'required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('cost') }}</p>
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
