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
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_sub_categories_edit_edit_category') }} </h3>
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
            <form id="create-category" action="{{route('dashboard.subCategories.update',['id'=>$resource->id])}}" method="post"
                enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
                {{csrf_field()}}

                <div class="col-md-12">
                    <h3 class="secondry-title">{{ trans('web.dashboard_sub_categories_edit_category_info') }}.</h3>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_sub_categories_edit_name') }}</label>
                        <input type="text" class="form-control" id="formInput25" required name="name" value="{{ $resource->name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="form-label" for="category_id">{{ trans('web.dashboard_sub_categories_edit_sections') }}</label>
                        <span class="desc"></span>
                        <div class="controls">
                            {{ Form::select('category_id' , $categories , $resource->category_id , ['class' => 'form-control' , 'placeholder' => 'Choose category' , 'autocomplete' => 'off']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="tags">
                            {{ trans('web.dashboard_sub_categories_edit_tags_seperated') }}
                        </label>
                        <textarea name="tags" id="tags" class="form-control" placeholder="tag1 tag2 tag3 ..">{{ $resource->tags }}</textarea>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_sub_categories_edit_save') }}</button>
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
