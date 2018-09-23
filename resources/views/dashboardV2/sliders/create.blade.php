@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_sliders_create_create_slider') }} </h3>
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
            <form action="{{ route('dashboard.sliders.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <h3 class="secondry-title">{{ trans('web.dashboard_sliders_create_info') }}.</h3>
                </div>

                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_sliders_create_image') }}</label>
                        <input type="file" name="image" id="banner" required class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="tag">
                            {{ trans('web.dashboard_sliders_create_page_form_tag') }}
                        </label>
                        <input type="text" name="tag" id="tag" class="form-control" value="{{ old('tag') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="head1">
                            {{ trans('web.dashboard_sliders_create_page_form_head1') }}
                        </label>
                        <input type="text" name="head1" id="head1" class="form-control" value="{{ old('head1') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="head2">
                            {{ trans('web.dashboard_sliders_create_page_form_head2') }}
                        </label>
                        <input type="text" name="head2" id="head2" class="form-control" value="{{ old('head2') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="desc">
                            {{ trans('web.dashboard_sliders_create_page_form_desc') }}
                        </label>
                        <input type="text" name="desc" id="desc" class="form-control" value="{{ old('desc') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="url">
                            {{ trans('web.dashboard_sliders_create_page_form_url') }}
                        </label>
                        <input type="text" name="url" id="url" class="form-control" value="{{ old('url') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="action_text">
                            {{ trans('web.dashboard_sliders_create_page_form_action_text') }}
                        </label>
                        <input type="text" name="action_text" id="action_text" class="form-control" value="{{ old('action_text') }}">
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_sliders_create_save') }}</button>
                        <button type="reset" class="btn btn-danger">{{ trans('web.dashboard_sliders_create_reset') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
