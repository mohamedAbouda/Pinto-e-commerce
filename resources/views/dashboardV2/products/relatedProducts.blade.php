@extends('layouts.dashboard.app')

@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_products_related_create') }}  </h3>
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
            <form id="create-inventory" action="{{route('dashboard.store.related.products')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="col-md-12">
                    <h3 class="secondry-title">{{ trans('web.dashboard_products_related_related') }}.</h3>
                </div>
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_related_choose') }}</label><br>
                        @foreach($products as $product)
                        <input type="checkbox" value="{{$product->id}}" id="formInput25"  name="product_ids[]">{{$product->name}}<br>
                        @endforeach
                    </div>

                </div>
              
     
         

               
                <input type="hidden" name="product_id" value="{{$productId}}">
          

                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_products_related_save') }}</button>
                    </div>
                </div>
            </form>
            {{--     <div class="col-md-3">
                <div class="form-group margin-bottom20">
                    <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_related_pic') }}</label>
                    <input type="file" class="form-control input-file-mod hidden" required>
                    <img src="{{asset('assets/panel-assets/images/fields/01_picture.png')}}" class="img-responsive input-file-custom" onclick="$('.input-file-mod').click();" />
                </div>
            </div> --}}
        </div>
    </div>
</div>


@stop
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script type="text/javascript" src="{{ asset('assets/panel-assets/js/jquery-1.11.1.min.js') }}"></script>
<script type="text/javascript">
$(".select2").select2();


</script>
<script type="text/javascript">

</script>
@stop
