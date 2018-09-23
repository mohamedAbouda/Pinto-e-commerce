@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h3 class="section-title">{{trans('web.dashboard_mrechant_admins_pages_index_edit_admin')}} "{{ $resource->name }}"</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => ['dashboard.merchant_admins.update',$resource->id] ,'method' => 'PATCH']) }}
<input type="hidden" name="resource_id" value="{{ $resource->id }}">
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">{{trans('web.dashboard_mrechant_pages_edit_admin_info')}}</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
                {{trans('web.dashboard_mrechant_pages_edit_name')}}
            </label>
            {{ Form::text('name',$resource->name,['id'=>'name','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('name') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="email">
                <span class="text-danger">*</span>
                {{trans('web.dashboard_mrechant_pages_edit_email')}}
            </label>
            {{ Form::email('email',$resource->email,['id'=>'email','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('email') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="phone">
                <span class="text-danger">*</span>
                {{trans('web.dashboard_mrechant_pages_edit_phone_number')}}
            </label>
            {{ Form::text('phone',$resource->phone,['id'=>'phone','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('phone') }}</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="password">
                <span class="text-danger">*</span>
                {{trans('web.dashboard_mrechant_pages_edit_password')}}
            </label>
            {{ Form::password('password',['id'=>'password','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('password') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="password_confirmation">
                <span class="text-danger">*</span>
               {{trans('web.dashboard_mrechant_pages_edit_confirm_password')}}
            </label>
            {{ Form::password('password_confirmation',['id'=>'password_confirmation','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('password_confirmation') }}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-xs-4">
        <button type="submit" class="btn primary-btn">{{trans('web.dashboard_mrechant_pages_edit_save')}}</button>
    </div>
    <div class="col-md-1 col-xs-4">
        <button type="reset" class="btn cancel-btn">{{trans('web.dashboard_mrechant_pages_edit_cancel')}}</button>
    </div>
</div>
{{ Form::close() }}
@stop
