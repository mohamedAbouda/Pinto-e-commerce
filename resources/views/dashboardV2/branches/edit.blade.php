@extends('layouts.dashboard.app')

@section('stylesheets')
{{ Html::style('assets/panel-assets/plugins/select2/dist/css/select2.min.css') }}
<style>
.select2-selection {
    width: 100%;
    height: 40px !important;
    line-height: 1.467 !important;
    padding: 8px 12px !important;
    font-size: 14px;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.select2-selection__arrow {
    margin-top: 6px;
}
</style>
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">{{ trans('web.dashboard_branches_pages_edit_page_section_title_edit_branch') }}</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => ['dashboard.branches.update' ,$resource->id] ,'method' => 'PATCH']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">{{ trans('web.dashboard_branches_pages_create_page_branch_info') }}.</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="name">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_branches_pages_create_page_form_title_activation_start') }}
            </label>
            {{ Form::text('name', $resource->name ,['id'=>'name','required'=>'required','class' => 'form-control' , 'placeholder' => 'Branch name']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('name') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="governorate_id">
                <span class="text-danger">*</span>
                {{ trans('web.dashboard_branches_pages_create_page_form_title_governorate') }}
            </label>
            {{ Form::select('governorate_id', $governorates , $resource->governorate_id ,['id'=>'governorate_id','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('governorate_id') }}</p>
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

@section('scripts')
{{ Html::script('assets/panel-assets/plugins/select2/dist/js/select2.full.min.js') }}
<script type="text/javascript">
$(document).ready(function(){
    $('select').select2({
        tags: true
    });
});
</script>
@stop
