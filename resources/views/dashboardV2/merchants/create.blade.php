@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">{{trans('web.dashboard_mrechant_pages_edit_add_new_merchant')}}</h3>
    </div>
      <div class="col-xs-12 col-md-3">
        <div class="row">
            <div class="col-md-4 sort-col col-xs-4">
            </div>
            <div class="col-md-3 contact-edit-col col-xs-4">
            </div>
        </div>
    </div>
  
</div>
@stop

@section('content')
{{ Form::open(['route' => ['dashboard.merchants.index'],'method' => 'post','files'=>'true']) }}

    {{csrf_field()}}
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
            {{ Form::text('name',old('name'),['id'=>'name','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('name') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="email">
                <span class="text-danger">*</span>
                {{trans('web.dashboard_mrechant_pages_edit_email')}}
            </label>
            {{ Form::email('email',old('email'),['id'=>'email','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('email') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="phone">
                <span class="text-danger">*</span>
                {{trans('web.dashboard_mrechant_pages_edit_phone_number')}}
            </label>
            {{ Form::text('phone',old('phone'),['id'=>'phone','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('phone') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <div class="form-group">
                <label class="control-label" for="profile_pic">
                    {{trans('web.dashboard_mrechant_pages_edit_profile_pic')}}
                </label>
                <div class="clearfix"></div>
                <label for="profile_pic">
                    <img src="{{ asset('assets/panel-assets/images/fields/01_picture.png') }}" alt="" class="thumbnail" style="width:215px;height:215px;cursor: pointer; cursor: hand;">
                    <input type="file" name="profile_pic" id="profile_pic" style="display:none;" onchange="preview(this);">
                </label>
            </div>
        </div>
        
       
        <div class="form-group margin-bottom20 col-md-6">
            <div class="form-group">
                <label class="control-label" for="cover_pic">
                   {{trans('web.dashboard_mrechant_pages_edit_cover_pic')}}
                </label>
                <div class="clearfix"></div>
                <label for="cover_pic">
                    <img src="{{ asset('assets/panel-assets/images/fields/01_picture.png') }}" alt="" class="thumbnail" style="width:215px;height:215px;cursor: pointer; cursor: hand;">
                    <input type="file" name="cover_pic" id="cover_pic" style="display:none;" onchange="preview(this);">

                </label>
            </div>
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
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="bio">
                {{trans('web.dashboard_mrechant_pages_edit_bio')}}
            </label>
            {{ Form::textarea('bio',old('bio'),['id'=>'bio','class' => 'form-control','style' => 'resize: none;']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('bio') }}</p>
        </div>
    </div>
    <div class="col-md-12">
        <h3 class="secondry-title">{{trans('web.dashboard_mrechant_pages_edit_admin_info')}}</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="Address">
                {{trans('web.dashboard_mrechant_pages_edit_address')}}
            </label>
            {{ Form::text('address',old('address'),['id'=>'address','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('address') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="country">
                {{trans('web.dashboard_mrechant_pages_edit_country')}}
            </label>
            {{ Form::text('country',old('country'),['id'=>'country','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('country') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="city">
                {{trans('web.dashboard_mrechant_pages_edit_city')}}
            </label>
            {{ Form::text('city',old('city'),['id'=>'city','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('city') }}</p>
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

@section('scripts')
<script type="text/javascript">
function preview(input)
{
    var parent = $(input).parent();
    var preview = parent.find('img');
    var file    = input.files[0];
    var reader  = new FileReader();

    reader.addEventListener("load", function () {
        preview.attr('src',reader.result);
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}
</script>
@stop
