@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">
            {{ trans('web.dashboard_contacts_pages_edit_page_contact_title_edit_contact') }}
        </h3>
    </div>
</div>
@stop

@section('content')
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row">
            {{ Form::open(['route' => ['dashboard.contact.update',$contact->id],'method' => 'PATCH']) }}
            <div class="col-md-12">
                <h3 class="secondry-title">{{ trans('web.dashboard_contacts_pages_create_page_contact_info') }}.</h3>
            </div>
            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >{{ trans('web.dashboard_contacts_pages_create_page_form_title_email') }}</label>
                    <input type="text" class="form-control" name="email" value="{{$contact->email}}">
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" > {{ trans('web.dashboard_contacts_pages_create_page_form_title_facebook') }}</label>
                    <input type="text" class="form-control" name="facebook" value="{{$contact->facebook}}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" > {{ trans('web.dashboard_contacts_pages_create_page_form_title_twitter') }}</label>
                    <input type="text" class="form-control" name="twitter" value="{{$contact->twitter}}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        {{ trans('web.dashboard_contacts_pages_create_page_form_title_google') }}
                    </label>
                    <input type="text" class="form-control" name="google" value="{{$contact->google
                    }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        {{ trans('web.dashboard_contacts_pages_create_page_form_title_instagram') }}
                    </label>
                    <input type="text" class="form-control" name="instagram" value="{{$contact->instagram}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        {{ trans('web.dashboard_contacts_pages_create_page_form_title_address') }}
                    </label>
                    <input type="text" class="form-control" name="address" value="{{$contact->address}}">
                </div>

            </div>
            <div class="col-md-12">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        {{ trans('web.dashboard_contacts_pages_create_page_form_title_phones') }}
                    </label>
                    <textarea class="form-control" name="phones">{{$contact->phones}}</textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        Store location title (1)
                    </label>
                    <input type="text" class="form-control" name="store_location_title_1" value="{{ $contact->store_location_title_1 }}" placeholder="Pinto Store NY">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        Store location address (1)
                    </label>
                    <input type="text" class="form-control" name="store_location_address_1" value="{{ $contact->store_location_address_1 }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        Store location hours (1)
                    </label>
                    <input type="text" class="form-control" name="store_location_hours_1" value="{{ $contact->store_location_hours_1 }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        Store location title (2)
                    </label>
                    <input type="text" class="form-control" name="store_location_title_2" value="{{ $contact->store_location_title_2 }}" placeholder="Pinto Store UK">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        Store location address (2)
                    </label>
                    <input type="text" class="form-control" name="store_location_address_2" value="{{ $contact->store_location_address_2 }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        Store location hours (2)
                    </label>
                    <input type="text" class="form-control" name="store_location_hours_2" value="{{ $contact->store_location_hours_2 }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        Store location title (3)
                    </label>
                    <input type="text" class="form-control" name="store_location_title_3" value="{{ $contact->store_location_title_3 }}" placeholder="Pinto Store EG">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        Store location address (3)
                    </label>
                    <input type="text" class="form-control" name="store_location_address_3" value="{{ $contact->store_location_address_3 }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group margin-bottom20">
                    <label class="control-label" >
                        Store location hours (3)
                    </label>
                    <input type="text" class="form-control" name="store_location_hours_3" value="{{ $contact->store_location_hours_3 }}">
                </div>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                <div class="text-left">
                    <button type="submit" class="btn btn-primary">
                        {{ trans('web.dashboard_create_page_save_button') }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
@section('scripts')
<script type="text/javascript" src="{{ asset('dashboard/plugins/select2.js') }}"></script>
<script type="text/javascript">
$(function(){
    $("#Icon li a").click(function(e){
        e.preventDefault();
        $(".Icon").text($(this).text());
        $('input[name=icon]').val($(this).text());
    });
});
</script>
@stop
