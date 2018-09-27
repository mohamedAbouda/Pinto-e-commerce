@extends('layouts.dashboard.app')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2.css') }}">
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">
            {{ trans('web.dashboard_contacts_pages_create_page_contact_title_create_contact') }}
        </h3>
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

<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row">
            <form id="create-category" action="{{route('dashboard.contact.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-12">
                    <h3 class="secondry-title">{{ trans('web.dashboard_contacts_pages_create_page_contact_info') }}.</h3>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            {{ trans('web.dashboard_contacts_pages_create_page_form_title_email') }}
                        </label>
                        <input type="text" class="form-control"  name="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            {{ trans('web.dashboard_contacts_pages_create_page_form_title_facebook') }}
                        </label>
                        <input type="text" class="form-control"  name="facebook">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            {{ trans('web.dashboard_contacts_pages_create_page_form_title_twitter') }}
                        </label>
                        <input type="text" class="form-control"  name="twitter">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            {{ trans('web.dashboard_contacts_pages_create_page_form_title_google') }}
                        </label>
                        <input type="text" class="form-control"  name="google">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            {{ trans('web.dashboard_contacts_pages_create_page_form_title_instagram') }}
                        </label>
                        <input type="text" class="form-control"  name="instagram">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            {{ trans('web.dashboard_contacts_pages_create_page_form_title_address') }}
                        </label>
                        <input type="text" class="form-control"  name="address">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            {{ trans('web.dashboard_contacts_pages_create_page_form_title_phones') }}
                        </label>
                        <textarea class="form-control" name="phones" placeholder="phone1,phone2,phone3"></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            Store location title (1)
                        </label>
                        <input type="text" class="form-control" name="store_location_title_1" value="{{ old('store_location_title_1') }}" placeholder="Pinto Store NY">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            Store location address (1)
                        </label>
                        <input type="text" class="form-control" name="store_location_address_1" value="{{ old('store_location_address_1') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            Store location hours (1)
                        </label>
                        <input type="text" class="form-control" name="store_location_hours_1" value="{{ old('store_location_hours_1') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            Store location title (2)
                        </label>
                        <input type="text" class="form-control" name="store_location_title_2" value="{{ old('store_location_title_2') }}" placeholder="Pinto Store UK">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            Store location address (2)
                        </label>
                        <input type="text" class="form-control" name="store_location_address_2" value="{{ old('store_location_address_2') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            Store location hours (2)
                        </label>
                        <input type="text" class="form-control" name="store_location_hours_2" value="{{ old('store_location_hours_2') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            Store location title (3)
                        </label>
                        <input type="text" class="form-control" name="store_location_title_3" value="{{ old('store_location_title_3') }}" placeholder="Pinto Store EG">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            Store location address (3)
                        </label>
                        <input type="text" class="form-control" name="store_location_address_3" value="{{ old('store_location_address_3') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" >
                            Store location hours (3)
                        </label>
                        <input type="text" class="form-control" name="store_location_hours_3" value="{{ old('store_location_hours_3') }}">
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">
                            {{ trans('web.dashboard_create_page_save_button') }}
                        </button>
                    </div>
                </div>
            </form>
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
