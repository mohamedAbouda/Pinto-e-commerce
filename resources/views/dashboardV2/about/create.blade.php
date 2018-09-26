@extends('layouts.dashboard.app')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2.css') }}">
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_about_pages_create_page_section_title_create_about') }}</h3>
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
            <form id="create-category" action="{{route('dashboard.about.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="col-md-12">
                    <h3 class="secondry-title">{{ trans('web.dashboard_about_pages_create_page_about_info') }}.</h3>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="about_header">Our brand header label</label>
                        <input type="text" name="about_header" id="about_header" class="form-control" value="{{ $about ? $about->about_header : old('about_header') }}">
                    </div>
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="description">{{ trans('web.dashboard_about_pages_create_page_about') }} </label>
                        <textarea class="form-control" name="description">{{ $about ? $about->description : old('description') }}</textarea>
                    </div>
                    <div class="form-group margin-bottom20">
                        <?php if ($about && $about->brand_image): ?>
                            <img src="{{ $about->brand_image_url }}" class="thumbnail col-md-3">
                        <?php endif; ?>
                        <input type="file" name="brand_image" id="brand_image" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="mission_header">Our mission header label</label>
                        <input type="text" name="mission_header" id="mission_header" class="form-control" value="{{ $about ? $about->mission_header : old('mission_header') }}">
                    </div>
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="mission_description">Description</label>
                        <textarea class="form-control" name="mission_description">{{ $about ? $about->mission_description : old('mission_description') }}</textarea>
                    </div>
                    <div class="form-group margin-bottom20">
                        <?php if ($about && $about->mission_image): ?>
                            <img src="{{ $about->mission_image_url }}" class="thumbnail col-md-3">
                        <?php endif; ?>
                        <input type="file" name="mission_image" id="mission_image" class="form-control">
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_create_page_save_button') }}</button>
                        <button type="reset" id="resetBtn" onclick="window.location=window.location" class="btn btn-danger">{{ trans('web.dashboard_create_page_reset_button') }}</button>
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
</script>
@stop
