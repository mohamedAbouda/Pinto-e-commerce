@extends('layouts.dashboard.app')


@section('stylesheets')
<link rel="stylesheet" href="{{ asset('assets/panel-assets/plugins/select2/dist/css/select2.min.css') }}">
@stop


@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_products_edit_update_product') }} </h3>
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
            <div class="bs-docs-example">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#product" data-toggle="tab">{{ trans('web.dashboard_products_edit_product') }}</a></li>
                    <li><a href="#key" data-toggle="tab">{{ trans('web.dashboard_products_edit_key_words') }}</a></li>
                    <li><a href="#shipping" data-toggle="tab">{{ trans('web.dashboard_products_edit_shipping') }}</a></li>
                    <li><a href="#related" data-toggle="tab">{{ trans('web.dashboard_products_edit_related_products') }}</a></li>
                    <li><a href="#inventory" data-toggle="tab"> {{ trans('web.dashboard_products_edit_inventory') }}</a></li>
                    <li><a href="#discount" data-toggle="tab"> {{ trans('web.dashboard_products_edit_discount') }}</a></li>
                    <li><a href="#images" data-toggle="tab"> {{ trans('web.dashboard_products_edit_cover_images') }}</a></li>
                </ul>

                <form  id="main-form-submit" action="{{ route('dashboard.products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade in active" id="product">
                            <div class="col-md-12">
                                <h3 class="secondry-title">{{ trans('web.dashboard_products_edit_product_info') }}.</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_product_name') }}</label>
                                    <input type="text" class="form-control" id="" required name="name" value="{{$product->name}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_category') }}</label>
                                    <select name="sub_category_id" onchange="onCategoryChangeSub()" id="selectCategoryChagne"   class="form-control select2" >
                                        <option selected disabled>{{ trans('web.dashboard_products_edit_please_select_category') }}</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_please_select_category') }}</label>
                                    <select name="sub_category_id"  id="selectValue" class="form-control select2"  onchange="categoryChange()">
                                        <option selected disabled>{{ trans('web.dashboard_products_edit_please_select_category') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_pricy') }}</label>
                                    <input type="number" id="priceInput" min="1" name="price" required  class="form-control" value="{{$product->price}}">
                                    <p class="AppendP"></p>
                                    <p id="AppendPrice"></p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_short_description') }}</label>
                                    <textarea  name="short_description" required class="form-control autogrow" rows="5" cols="5" >{{$product->short_description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label">
                                        {{ trans('web.dashboard_products_edit_description') }}
                                        <span class="text-info" style="font-size:12px;">Please complete at least one section</span>
                                    </label>
                                    <h5 class="secondry-title" style="font-size: unset;">1st section.</h5>
                                    <input type="file" name="description_section_1_image" class="form-control margin-bottom10" accept="image/*">
                                    <input type="text" class="form-control margin-bottom10" name="description_section_1_head" value="{{ $product->description_section_1_head }}">
                                    <textarea name="description_section_1_text" class="form-control autogrow margin-bottom10">{{ $product->description_section_1_text }}</textarea>
                                </div>
                                <div class="form-group">
                                    <h5 class="secondry-title" style="font-size: unset;">2st section.</h5>
                                    <input type="file" name="description_section_2_image" class="form-control margin-bottom10" accept="image/*">
                                    <input type="text" class="form-control margin-bottom10" name="description_section_2_head_1" value="{{ $product->description_section_2_head_1 }}">
                                    <textarea name="description_section_2_text_1" class="form-control autogrow margin-bottom10">{{ $product->description_section_2_text }}</textarea>
                                    <input type="text" class="form-control margin-bottom10" name="description_section_2_head_2" value="{{ $product->description_section_2_head_2 }}">
                                    <textarea name="description_section_2_text_2" class="form-control autogrow margin-bottom10">{{ $product->description_section_2_text }}</textarea>
                                    <input type="text" class="form-control margin-bottom10" name="description_section_2_head_3" value="{{ $product->description_section_2_head_3 }}">
                                    <textarea name="description_section_2_text_3" class="form-control autogrow margin-bottom10">{{ $product->description_section_2_text }}</textarea>
                                    <input type="text" class="form-control margin-bottom10" name="description_section_2_head_4" value="{{ $product->description_section_2_head_4 }}">
                                    <textarea name="description_section_2_text_4" class="form-control autogrow margin-bottom10">{{ $product->description_section_2_text }}</textarea>
                                </div>
                                <div class="form-group">
                                    <h5 class="secondry-title" style="font-size: unset;">3st section.</h5>
                                    <input type="file" name="description_section_3_image" class="form-control margin-bottom10" accept="image/*">
                                    <textarea name="description_section_3_text" class="form-control autogrow margin-bottom10">{{ $product->description_section_3_text }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label">{{ trans('web.dashboard_products_edit_key_word_info') }}</label>
                                    <input type="text" class="form-control margin-bottom10" name="description_section_3_head" value="{{ $product->description_section_3_head }}">
                                    <textarea name="technical_specs" class="form-control autogrow" rows="5" cols="5" id="technical_specs">{{ $product->technical_specs }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="key">
                            <div class="col-md-12">
                                <h3 class="secondry-title">{{ trans('web.dashboard_products_edit_key_text') }}.</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_product_shipping_cost') }}</label>
                                    @if($product->keyWord)
                                    <textarea name="text" class="form-control" required>{{$product->keyWord->text}}</textarea>
                                    @else
                                    <textarea name="text" class="form-control" required></textarea>
                                    @endif
                                    ** split the words by space
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="shipping">
                            <div class="col-md-12">
                                <h3 class="secondry-title">{{ trans('web.dashboard_products_edit_shipping_by_site') }}.</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for=""></label>
                                    <input type="checkbox" {{$product->generalProduct && $product->generalProduct->shipping_category ? 'checked':''}} value="1" id=""  name="shipping_category">{{ trans('web.dashboard_products_edit_shipping_by_merchant') }}
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for=""></label>
                                    <input type="checkbox" id=""  name="shipping_merchant" {{$product->generalProduct && $product->generalProduct->shipping_cost ? 'checked':''}}>Shipping By Merchant<br>
                                    <input type="number" min="1" class="form-control" name="shipping_cost" placeholder="Merchant Shipping Cost" value="{{ $product->generalProduct ? $product->generalProduct->shipping_cost : 0 }}">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="related">
                            <div class="col-md-12">
                                <h3 class="secondry-title">{{ trans('web.dashboard_products_edit_related_products') }}.</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_choose_related_products') }}</label><br>
                                    @foreach($productsRelated as $pro)
                                    <input type="checkbox" value="{{$pro->id}}" {{in_array($pro->id,$relatedProductIds )? 'checked':''}} id=""  name="product_ids[]">{{$pro->name}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="images">
                            <div class="col-md-12">
                                <h3 class="secondry-title">{{ trans('web.dashboard_products_edit_p_images') }}.</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_p_cover') }}</label>
                                    <input type="file" name="cover_image" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="{{$product->cover_image_url}}" style="width: 200px;max-width: 200px;height: 150px;max-height: 150px;">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_product_images') }}</label>

                                    <input type="file" name="images[]" class="form-control" multiple>
                                </div>
                            </div>
                        </form>

                        @foreach($product->images as $image)
                        <div style="display:inline-block;" id="image{{$image->id}}">
                            <img src="{{$image->image_url}}" class="imageProductDelete" style="width: 250px;max-width: 250px;height: 200px;max-height: 200px;">
                            <form action="{{route('dashboard.delete.image.product')}}" method="post" class="deleteImage-form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{$image->id}}">
                                <input type="hidden" name="product_id" value="{{$image->product_id}}">
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="discount">

                        <div class="row margin-top15">
                            <div class="col-md-12">
                                <div class="row">
                                    <form id="create-discount" action="{{route('dashboard.product.add.discount')}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}

                                        <div class="col-md-12">
                                            <h3 class="secondry-title">{{ trans('web.dashboard_products_edit_product_discount') }}.</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group margin-bottom20">
                                                <label class="control-label" for="">{{ trans('web.dashboard_products_edit_count') }}</label>
                                                <input type="number" min="1"  value="1" name="count" required class="form-control">
                                                <p class="text-danger">{{ $errors->first('count') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group margin-bottom20">
                                                <label class="control-label" for="">{{ trans('web.dashboard_products_edit_discount') }}</label>
                                                <input type="number" min="1" value="0" name="discount" required  class="form-control">
                                                <p class="text-danger">{{ $errors->first('discount') }}</p>
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{$product->id}}">

                                        <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                                            <p class="text-danger" style="display:none;">
                                                Validation errors ! count & discount fields should be >= 0
                                            </p>
                                            <div class="text-left">
                                                <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_products_edit_save') }}</button>
                                                <button type="reset" class="btn btn-danger">{{ trans('web.dashboard_products_edit_reset') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    {{--     <div class="col-md-3">
                                        <div class="form-group margin-bottom20">
                                            <label class="control-label" for="">{{ trans('web.dashboard_products_edit_picture') }}</label>
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
                                            <th>{{ trans('web.dashboard_products_edit_product_name') }}</th>
                                            <th>{{ trans('web.dashboard_products_edit_count') }}</th>
                                            <th>{{ trans('web.dashboard_products_edit_discount') }}</th>
                                            <th>{{ trans('web.dashboard_products_edit_action') }}</th>
                                        </thead>
                                        <tbody id="bodyTableDiscount">
                                            @foreach($product->discountCount as $discountProduct)
                                            <tr id="discount{{$discountProduct->id}}">
                                                <td>{{$discountProduct->product->name}}</td>
                                                <td>{{$discountProduct->count}}</td>
                                                <td>{{$discountProduct->discount}}</td>
                                                <td>
                                                    <form action="{{route('dashboard.product.delete.discount')}}" style="display: inline-block" class="deleteDiscount-form" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{$discountProduct->id}}">
                                                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> {{ trans('web.dashboard_products_edit_delete') }}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="inventory">
                        <form id="create-inventory" action="{{route('dashboard.save.product.inventory')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-md-6">
                                <h3 class="secondry-title">{{ trans('web.dashboard_products_edit_product_inventory') }}.</h3>
                            </div>
                            @if($subCategory && $subCategory->category && $subCategory->category->has_size == 1)
                            <div class="col-md-12">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label"> {{ trans('web.dashboard_products_add_stock_size') }}</label>
                                    {{ Form::select('size' ,$sizes ,NULL ,['class' => 'form-control' ,'multiple' => 'multiple' ,'required' => 'required']) }}
                                </div>
                            </div>
                            @endif

                            @if($subCategory && $subCategory->category && $subCategory->category->has_color == 1)
                            <div class="col-md-6">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label"> {{ trans('web.dashboard_products_add_stock_color') }}</label>
                                    {{ Form::select('color' ,$colors ,NULL ,['class' => 'form-control' ,'multiple' => 'multiple' ,'required' => 'required']) }}
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_p_sku') }}</label>
                                    <input type="text" name="sku" required  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_p_amount') }}</label>
                                    <input type="number"  name="amount" required  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_p_weight') }}</label>
                                    <input type="number" min="0.01"  name="weight" step="0.01"   class="form-control">
                                </div>
                            </div>
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div class="col-md-12">
                                <div class="form-group margin-bottom20">
                                    <label class="control-label" for="">{{ trans('web.dashboard_products_edit_note') }}</label>
                                    <textarea  name="note" required class="form-control autogrow" rows="5" cols="5" >{{ old('note') }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_products_edit_add') }}</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>{{ trans('web.dashboard_products_edit_p_name') }}</th>
                                            <th>{{ trans('web.dashboard_products_edit_size') }}</th>
                                            <th>{{ trans('web.dashboard_products_edit_weight') }}</th>
                                            <th>{{ trans('web.dashboard_products_edit_color') }}</th>
                                            <th>{{ trans('web.dashboard_products_edit_sku') }}</th>
                                            <th>{{ trans('web.dashboard_products_edit_amount') }}</th>

                                        </thead>
                                        <tbody id="bodyTable">
                                            @foreach($product->stocks as $stock)
                                            <tr id="stock{{$stock->id}}">
                                                <td>{{$product->name}}</td>
                                                <td>{{$stock->size}}</td>
                                                <td>{{$stock->weight}}</td>
                                                <td>{{$stock->color}}</td>
                                                <td>{{$stock->sku}}</td>
                                                <td>{{$stock->amount}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-1 col-xs-4">
    <button type="button" id="submit-btn-form" class="btn primary-btn">{{ trans('web.dashboard_products_edit_save') }}</button>
</div>
@stop
@section('scripts')
<script type="text/javascript" src="{{ asset('assets/panel-assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script type="text/javascript">
$(".select2").select2({
    placeholder:'choose an option',
});
CKEDITOR.replace( 'description' );
CKEDITOR.replace( 'technical_specs' );

</script>
<script type="text/javascript">
$('.deleteImage-form').submit(function(e){

    e.preventDefault();
    var form = jQuery(this);
    var dataString = new FormData(this);
    var formAction = form.attr('action');

    $.ajax({
        type: "POST",
        url : formAction,
        data : dataString,
        cache:false,
        contentType: false,
        processData: false,
        success : function(data){
            $('#image'+data).remove();

        },
        error : function(data){


        }

    }),"JSON";

});

</script>
<script type="text/javascript">
$("select[name='size'] ,select[name='color']").select2({
    tags: true
});
CKEDITOR.replace('info');
CKEDITOR.replace('stylist');
CKEDITOR.replace('delivery');
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
        }
    });
}
</script>
<script type="text/javascript">
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

$('.deleteImage-form').submit(function(e){

    e.preventDefault();
    var form = jQuery(this);
    var dataString = new FormData(this);
    var formAction = form.attr('action');

    $.ajax({
        type: "POST",
        url : formAction,
        data : dataString,
        cache:false,
        contentType: false,
        processData: false,
        success : function(data){
            $('#image'+data).remove();

        },
        error : function(data){


        }

    }),"JSON";

});

$('#submit-btn-form').click(function(){
    $('#main-form-submit').submit();
});
</script>
<script type="text/javascript">
$('#create-discount').submit(function(e){
    e.preventDefault();
    var form = jQuery('#create-discount');
    var dataString = form.serialize();
    var formAction = form.attr('action');
    $.ajax({


        type: "POST",
        url : formAction,
        data : dataString,
        dataType: 'json',
        success : function(data){
            if (typeof data.errors != 'undefined') {
                form.find('p.text-danger').show();
                return ;
            }
            form.find('p.text-danger').hide();

            var stock = `

            <tr id="discount`+data['id']+`">
            <td>`+data['product'].name+`</td>
            <td>`+data['count']+`</td>
            <td>`+data['discount']+`</td>
            <td>
            <form action="{{route('dashboard.product.delete.discount')}}" style="display: inline-block" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="`+data['id']+`">
            <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
            </form>
            </td>
            </tr>
            `;

            $('#bodyTableDiscount').append(stock);
            $("form").addClass("deleteDiscount-form");
            document.getElementById("create-discount").reset();
        },
        error : function(data){

        }

    },"json");
});


$('table').on('submit','.deleteDiscount-form',function(e) {

    e.preventDefault();

    var form = jQuery(this);
    var dataString = form.serialize();
    var formAction = form.attr('action');
    $.ajax({


        type: "POST",
        url : formAction,
        data : dataString,
        success : function(data){
            $('#discount'+data).remove();
        },
        error : function(data){

        }

    },"json");




});

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
