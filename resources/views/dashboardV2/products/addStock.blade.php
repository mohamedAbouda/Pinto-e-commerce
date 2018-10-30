@extends('layouts.dashboard.app')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2.css') }}">
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_products_add_stock_add') }} </h3>
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
            <form id="create-category" action="{{route('dashboard.products.save.stock')}}" method="post" enctype="multipart/form-data">

                {{csrf_field()}}


                <div class="col-md-12">
                    <h3 class="secondry-title">{{ trans('web.dashboard_products_add_stock_info') }}.</h3>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25"> {{ trans('web.dashboard_products_add_stock_amount') }}</label>
                        <input type="number" min="1" class="form-control" id="formInput25" required name="amount">
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25"> {{ trans('web.dashboard_products_add_stock_note') }}</label>
                        <textarea class="form-control" name="note"></textarea>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25"> {{ trans('web.dashboard_products_add_stock_sku') }}</label>
                        <input type="text" min="1" class="form-control" id="formInput25" required name="sku">
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25"> {{ trans('web.dashboard_products_add_stock_size') }}</label>
                        <input type="text" min="1" class="form-control" id="formInput25" required name="size">
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25"> {{ trans('web.dashboard_products_add_stock_color') }}</label>
                        <input type="text" min="1" class="form-control" id="formInput25" required name="color">
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label"> {{ trans('web.dashboard_products_add_stock_size') }}</label>
                        {{ Form::select('size' ,$sizes ,NULL ,['class' => 'form-control' ,'multiple' => 'multiple' ,'required' => 'required']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label"> {{ trans('web.dashboard_products_add_stock_color') }}</label>
                        {{ Form::select('color' ,$colors ,NULL ,['class' => 'form-control' ,'multiple' => 'multiple' ,'required' => 'required']) }}
                    </div>
                </div>
                <input type="hidden" name="value" value="positive">
                <input type="hidden" name="product_id" value="{{$id}}">

                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_products_add_stock_save') }}</button>
                        <button type="reset" class="btn btn-danger">{{ trans('web.dashboard_products_add_stock_reset') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script type="text/javascript" src="{{ asset('assets/panel-assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$(function(){
    $('select[name=size] ,select[name=color]').select2({
        tags: true
    });
});
</script>
@stop
