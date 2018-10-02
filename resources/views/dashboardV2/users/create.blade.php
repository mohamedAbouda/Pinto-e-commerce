@extends('layouts.dashboard.app')

@section('stylesheets')
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">{{ trans('web.dashboard_users_create_add_user') }}</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => ['dashboard.users.index'],'method' => 'post','files'=>'true']) }}<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">{{ trans('web.dashboard_users_create_user_info') }}.</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_users_create_name') }}
            </label>
            {{ Form::text('name',old('name'),['id'=>'name','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('name') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="email">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_users_create_email') }}
            </label>
            {{ Form::email('email',old('email'),['id'=>'email','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('email') }}</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="password">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_users_create_password') }}
            </label>
            {{ Form::password('password',['id'=>'password','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('password') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="password_confirmation">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_users_create_confirm_password') }}
            </label>
            {{ Form::password('password_confirmation',['id'=>'password_confirmation','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('password_confirmation') }}</p>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="profile_pic">
                <span class="text-danger"></span>
                {{ trans('web.dashboard_users_create_profile_picture') }}
            </label>
            {{ Form::file('profile_pic',['id'=>'profile_pic','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('profile_pic') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="password_confirmation">
                <span class="text-danger"></span>
                {{ trans('web.dashboard_users_create_phones') }}
            </label>
            {{ Form::text('phone',old('phone'),['id'=>'phone','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('phone') }}</p>
        </div>

        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="address">
                {{ trans('web.dashboard_users_create_address') }}
            </label>
            {{ Form::text('addresses[0][address]' , old('addresses[0][address]') , ['id' => 'address' ,'class' => 'form-control' ,'placeholder' => '']) }}
            <span class="text-danger" style="margin-bottom: 0;">{{ $errors->first('addresses[0][address]') }}</span>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="city">
                {{ trans('web.dashboard_users_create_city') }}
            </label>
            <div class="input-group">
                {{ Form::text('addresses[0][city]' , old('addresses[0][city]') , ['id' => 'city' ,'class' => 'form-control' ,'placeholder' => '']) }}
                <span class="input-group-btn">
                    <button id="add-new-address-btn" type="button" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                    </button>
                </span>
            </div>
            <span class="text-danger" style="margin-bottom: 0;">{{ $errors->first('addresses[0][city]') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-xs-4">
        <button type="submit" class="btn primary-btn">{{ trans('web.dashboard_users_create_save') }}</button>
    </div>
    <div class="col-md-1 col-xs-4">
        <button type="reset" class="btn cancel-btn">{{ trans('web.dashboard_users_create_cancel') }}</button>
    </div>
</div>
{{ Form::close() }}

<div id="address-mini-form" style="display:none;">
    <div class="form-group margin-bottom20 col-md-6">
        <label class="control-label">
            {{ trans('web.dashboard_users_create_address') }}
        </label>
        {{ Form::text('addresses[0][address]' , old('address') , ['class' => 'form-control' ,'placeholder' => '']) }}
    </div>
    <div class="form-group margin-bottom20 col-md-6">
        <label class="control-label">
            {{ trans('web.dashboard_users_create_city') }}
        </label>
        {{ Form::text('addresses[0][city]' , old('city') , ['class' => 'form-control' ,'placeholder' => '']) }}
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
    var address_mini_forms_counter = 0;
    $('#add-new-address-btn').click(function(){
        var address_form = $('#address-mini-form');
        address_form.find('input[name="addresses[' + address_mini_forms_counter + '][address]"]').attr('name' ,"addresses[" + (address_mini_forms_counter+1) + "][address]")
        address_form.find('input[name="addresses[' + address_mini_forms_counter + '][city]"]').attr('name' ,"addresses[" + (address_mini_forms_counter+1) + "][city]")

        address_mini_forms_counter++;

        var html = $('#address-mini-form').html();
        $(this).parents('.form-group.margin-bottom20.col-md-6').after(html);
    });
});
</script>
@stop
