@extends('layouts.dashboard.app')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2.css') }}">
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">
            {{ trans('web.dashboard_policy_pages_create_page_section_header_create_policy') }}
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
            <form id="create-category" action="{{route('dashboard.policy.store')}}" method="post" enctype="multipart/form-data">

                {{csrf_field()}}


                <div class="col-md-12">
                    <h3 class="secondry-title">
                        {{ trans('web.dashboard_policy_pages_create_page_policy_info') }}.
                    </h3>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">
                            {{ trans('web.dashboard_policy_pages_create_page_policy') }}
                        </label>
                        <textarea class="form-control" class="ck" name="body">{{old('description')}}</textarea>
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
<script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>

<script type="text/javascript">
CKEDITOR.replace('body');
</script>
@stop
