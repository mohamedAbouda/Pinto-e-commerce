@extends('layouts.dashboard.app')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('assets/panel-assets/plugins/select2/dist/css/select2.min.css') }}">
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_products_create_inve_create') }} </h3>
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
            <form id="create-inventory" action="{{route('dashboard.save.product.inventory')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="col-md-12">
                    <h3 class="secondry-title">{{ trans('web.dashboard_products_create_inve_inven') }}.</h3>
                </div>
                @if($subCategory && $subCategory->category)
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label">{{ trans('web.dashboard_products_create_inve_size') }}</label>
                        {{ Form::select('size' ,$sizes ,NULL ,['class' => 'form-control' ,'required' => 'required']) }}
                    </div>
                </div>
                @endif


                @if($subCategory && $subCategory->category)
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label">{{ trans('web.dashboard_products_create_inve_color') }}</label>
                        {{ Form::select('color' ,$colors ,NULL ,['class' => 'form-control' ,'required' => 'required']) }}
                    </div>
                </div>
                @endif

                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_inve_sku') }}</label>
                        <input type="text" name="sku" required  class="form-control">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_inve_amount') }}</label>
                        <input type="number"  name="amount" required  class="form-control">
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_inve_weight') }}</label>
                        <input type="number"  name="weight" step="0.01" min="0.01"  class="form-control">
                    </div>

                </div>
                <input type="hidden" name="product_id" value="{{$productId}}">



                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_inve_note') }}</label>
                        <textarea  name="note" required class="form-control autogrow" rows="5" cols="5" >{{ old('note') }}</textarea>
                    </div>
                </div>


                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_products_create_inve_save') }}</button>
                        <button type="reset" class="btn btn-danger">{{ trans('web.dashboard_products_create_inve_reset') }}</button>
                    </div>
                </div>
            </form>
            {{--     <div class="col-md-3">
                <div class="form-group margin-bottom20">
                    <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_inve_pic') }}</label>
                    <input type="file" class="form-control input-file-mod hidden" required>
                    <img src="{{asset('assets/panel-assets/images/fields/01_picture.png')}}" class="img-responsive input-file-custom" onclick="$('.input-file-mod').click();" />
                </div>
            </div> --}}
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <th>{{ trans('web.dashboard_products_create_inve_product_name') }}</th>
                    <th>{{ trans('web.dashboard_products_create_inve_size') }}</th>
                    <th>{{ trans('web.dashboard_products_create_inve_weight') }}</th>
                    <th>{{ trans('web.dashboard_products_create_inve_color') }}</th>
                    <th>{{ trans('web.dashboard_products_create_inve_sku') }}</th>
                    <th>{{ trans('web.dashboard_products_create_inve_amount') }}</th>


                </thead>
                <tbody id="bodyTable">





                </tbody>
            </table>
        </div>

    </div>
</div>
<form action="{{route('dashboard.product.shipping.page')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="product_id" value="{{$productId}}">
    <input type="submit" name="ok" value="Next" class="btn btn-primary">
</form>
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/panel-assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script type="text/javascript">
$(function(){
    $("select[name='size'] ,select[name='color']").select2({
        tags: true
    });
});

$('#create-inventory').submit(function(e){
    e.preventDefault();
    var form = jQuery('#create-inventory');
    var dataString = form.serialize();
    var formAction = form.attr('action');
    $.ajax({
        type: "POST",
        url : formAction,
        data : dataString,
        success : function(data){
            var stock = `
            <tr id="stock`+data['id']+`">
            <td>`+data['product'].name+`</td>
            <td>`+data['size']+`</td>
            <td>`+data['weight']+`</td>
            <td>`+data['color']+`</td>
            <td>`+data['sku']+`</td>
            <td>`+data['amount']+`</td>
            </tr>
            `;

            $('#bodyTable').append(stock);
            $("form").addClass("deleteStock-form");
            document.getElementById("create-inventory").reset();
        },
        error : function(data){
        }
    },"json");
});

$('table').on('submit','.deleteStock-form',function(e) {
    e.preventDefault();
    var form = jQuery(this);
    var dataString = form.serialize();
    var formAction = form.attr('action');
    $.ajax({
        type: "POST",
        url : formAction,
        data : dataString,
        success : function(data){
            $('#stock'+data).remove();
        },
        error : function(data){
        }
    },"json");
});
</script>
@stop
