@extends('layouts.dashboard.app')

@section('stylesheets')
{{ Html::style('assets/panel-assets/plugins/icheck-1/skins/square/blue.css') }}
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_banners_create_create_banner') }} </h3>
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
            <form action="{{ route('dashboard.banners.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <h3 class="secondry-title">{{ trans('web.dashboard_banners_create_info') }}.</h3>
                </div>

                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">
                            <span class="text-danger">
                                <strong>
                                    *
                                </strong>
                            </span>
                            {{ trans('web.dashboard_banners_create_image') }}
                        </label>
                        <input type="file" name="image" id="banner" required class="form-control" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="url">
                            <span class="text-danger">
                                <strong>
                                    *
                                </strong>
                            </span>
                            {{ trans('web.dashboard_banners_create_page_form_url') }}
                        </label>
                        <input type="text" name="url" id="url" class="form-control" value="{{ old('url') }}" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="tag">
                            {{ trans('web.dashboard_banners_create_page_form_tag') }}
                        </label>
                        <input type="text" name="tag" id="tag" class="form-control" value="{{ old('tag') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="title">
                            {{ trans('web.dashboard_banners_create_page_form_title') }}
                        </label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="body">
                            {{ trans('web.dashboard_banners_create_page_form_body') }}
                        </label>
                        <input type="text" name="body" id="body" class="form-control" value="{{ old('body') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="price">
                            {{ trans('web.dashboard_banners_create_page_form_price') }}
                        </label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" min="0" step="0.25">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="price">
                            <span class="text-danger">
                                <strong>
                                    *
                                </strong>
                            </span>
                            {{ trans('web.dashboard_banners_create_page_form_position') }}
                        </label>
                        <ul>
                            <li>
                                <input type="checkbox" name="position[]" value="Home page under main slider" id="home_page_under_slider_1" class="iCheck">
                                <label for="home_page_under_slider_1">
                                    Home page under main slider
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" name="position[]" value="Home page in the middle" id="home_page_middle_1" class="iCheck">
                                <label for="home_page_middle_1">
                                    Home page in the middle
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" name="position[]" value="Search page top" id="search_page_top" class="iCheck">
                                <label for="search_page_top">
                                    Search page top
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" name="position[]" value="Search page sidebar" id="search_page_sidebar" class="iCheck">
                                <label for="search_page_sidebar">
                                    Search page sidebar
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="price">
                            <span class="text-danger">
                                <strong>
                                    *
                                </strong>
                            </span>
                            {{ trans('web.dashboard_banners_create_page_form_status') }}
                        </label>
                        <select class="form-control" name="active">
                            <option value="1">Active</option>
                            <option value="0">Disabled</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_banners_create_save') }}</button>
                        <button type="reset" class="btn btn-danger">{{ trans('web.dashboard_banners_create_reset') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('scripts')
{{ Html::script('assets/panel-assets/plugins/icheck-1/icheck.min.js') }}
<script type="text/javascript">
$(document).ready(function(){
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
    });
});
</script>
@stop
