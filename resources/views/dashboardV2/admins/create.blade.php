@extends('layouts.dashboard.app')
@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">{{ trans('web.dashboard_admins_pages_create_page_section_title_create_admin') }}</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => 'dashboard.admins.store','files'=>'true']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">{{ trans('web.dashboard_admins_pages_create_page_admin_info') }}.</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_admins_pages_create_page_form_title_name') }}
            </label> {{ Form::text('name',old('name'),['id'=>'name','required'=>'required','class' => 'form-control'])
            }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('name') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="email">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_admins_pages_create_page_form_title_email') }}
            </label> {{ Form::email('email',old('email'),['id'=>'email','required'=>'required','class' => 'form-control'])
            }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('email') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="address">
                <span class="text-danger">*</span>
               Address
            </label>
            {{ Form::text('address',old('address'),['id'=>'address','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('address') }}</p>
        </div>
          <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="start_date">
                <span class="text-danger">*</span>
               Start Date
            </label>
            {{ Form::text('start_date',old('start_date'),['id'=>'start_date','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('start_date') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="national_id">
                <span class="text-danger">*</span>
               National Id
            </label>
            {{ Form::file('national_id',old('national_id'),['id'=>'national_id','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('national_id') }}</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="password">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_admins_pages_create_page_form_title_password') }}
            </label> {{ Form::password('password',['id'=>'password','required'=>'required','class' => 'form-control'])
            }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('password') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="password_confirmation">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_admins_pages_create_page_form_title_confirm_password') }}
            </label> {{ Form::password('password_confirmation',['id'=>'password_confirmation','required'=>'required','class'
            => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('password_confirmation') }}</p>
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

@section('stylesheets')
{{ Html::style('assets/panel-assets/plugins/datetimepicker/jquery.datetimepicker.css') }}
@stop

@section('scripts')
{{ Html::script('assets/panel-assets/plugins/datetimepicker/build/jquery.datetimepicker.full.min.js') }}
<script type="text/javascript">
$(document).ready(function(){
    $('#start_date').datetimepicker({
        format:'Y-m-d'
    });
});
</script>
@stop
