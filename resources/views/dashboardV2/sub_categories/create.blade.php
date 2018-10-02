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
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_sub_categories_create_create_category') }} </h3>
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
            <form id="create-category" action="{{route('dashboard.subCategories.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-12">
                    <h3 class="secondry-title">{{ trans('web.dashboard_sub_categories_create_category_info') }}.</h3>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_sub_categories_create_name') }}</label>
                        <input type="text" class="form-control" id="formInput25" required name="name">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <div class="controls">
                            {{ Form::select('category_id' , $categories , NULL , ['class' => 'form-control' , 'placeholder' => 'Choose Section' , 'autocomplete' => 'off']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="tags">
                            {{ trans('web.dashboard_sub_categories_create_tags_seperated') }}
                        </label>
                        <textarea name="tags" id="tags" class="form-control" placeholder="tag1 tag2 tag3 ..">{{ old('tags') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                <div class="text-left">
                    <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_sub_categories_create_save') }}</button>
                    <button type="reset" class="btn btn-danger">{{ trans('web.dashboard_sub_categories_create_reset') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@stop
@section('scripts')
{{ Html::script('assets/panel-assets/plugins/select2/dist/js/select2.full.min.js') }}
<script type="text/javascript">
$(document).ready(function(){
    $('select').select2();
});
</script>
@stop
