@extends('layouts.dashboard.app')

@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_products_create_create_product') }} </h3>
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
            <form id="create-product" action="{{route('dashboard.products.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="col-md-12">
                    <h3 class="secondry-title">{{ trans('web.dashboard_products_create_info') }}.</h3>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_name') }}</label>
                        <input type="text" class="form-control" id="formInput25" required name="name">
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_cat') }}</label>
                        <select name="sub_category_id" onchange="onCategoryChangeSub()" id="selectCategoryChagne" required  class="form-control select2" required>
                            <option selected disabled>{{ trans('web.dashboard_products_create_please_select_cateogry') }}</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_sub_category') }}</label>
                        <select name="sub_category_id" required id="selectValue" class="form-control select2" required onchange="categoryChange()">
                          <option selected disabled>{{ trans('web.dashboard_products_create_select_category_first') }}</option>
                        </select>
                    </div>
                </div>


                <input type="hidden" name="merchant_id" value="{{Auth::guard('merchant')->user()->merchant_id}}">


                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_price') }}</label>
                        <input type="number" id="priceInput" name="price" min="1" required  class="form-control">
                        <p class="AppendP"></p>
                        <p id="AppendPrice"></p>

                    </div>

                </div>

                <div class="col-md-12" id="brandDiv">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_brand') }}</label>
                        <select class="form-control select2" name="brand_id">
                            <option disabled selected>{{ trans('web.dashboard_products_create_select_brand') }}</option>
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>



                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_short') }}</label>
                        <textarea  name="short_description" required class="form-control autogrow" rows="5" cols="5" >{{ old('short_description') }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_desc') }}</label>
                        <textarea  name="description" class="form-control autogrow" rows="5" cols="5" id="description">{{old('description')}}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label">{{ trans('web.dashboard_products_create_tech') }}</label>
                        <textarea name="technical_specs" class="form-control autogrow" rows="5" cols="5" id="technical_specs">{{ old('technical_specs') }}</textarea>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_products_create_next') }}</button>
                        <button type="reset" class="btn btn-danger">{{ trans('web.dashboard_products_create_reset') }}</button>
                    </div>
                </div>
            </form>
            {{--     <div class="col-md-3">
                <div class="form-group margin-bottom20">
                    <label class="control-label" for="formInput25">{{ trans('web.dashboard_products_create_picture') }}</label>
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
<script type="text/javascript">
    $(".select2").select2();
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'technical_specs' );
    function categoryChange() {
     var id =  $('#selectValue').val();

     $.ajax({
        type: "POST",

        url: "{{route('dashboard.product.check.section')}}",
        data: {
           _token: "{{ csrf_token() }}",
           id: id
       },
       success: function(data) {
         console.log(data['payment_due_percentage']);
         $('.AppendP').text('The Site will take '+data['payment_due_percentage']+' % from any product in section '+data['name']);
         var price = $('#priceInput').val();
         var discountPercentage = 100 - data['payment_due_percentage'];
         var Discount =(price*discountPercentage)/100;
         if(price.length > 0){
            $('#AppendPrice').html('');
            $('#AppendPrice').append('You will get <strong><span></span>'+Discount+' EGP</strong>');
                console.log(Discount);
         }
         
     
         if(data['has_brand'] == 1){
            $('#brandDiv').css("display", "block");
        }else{
            $('#brandDiv').css("display", "none");
        }
    }
});
 }

 function onCategoryChangeSub() {
    var id =  $('#selectCategoryChagne').val();

    $.ajax({
        type: "POST",

        url: "{{route('dashboard.change.subCategory.ajax.admin')}}",
        data: {
           _token: "{{ csrf_token() }}",
           id: id
       },
       success: function(data) {
            var options = [];
             options.push(`
                    <option selected disabled>Select Sub-Cateogry</option>
                `);
            for(var i = 0;i < data.length;i++){
                options.push(`
                    <option value=`+data[i].id+`>`+data[i].name+`</option>
                `);

            }
            $('#selectValue').html('');
            $('#selectValue').append(options);
           
       }
   });
}
</script>
@stop
