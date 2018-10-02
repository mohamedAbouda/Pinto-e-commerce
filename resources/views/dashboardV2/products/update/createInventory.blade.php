@extends('layouts.dashboard.app')

@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">Create Product Inventory </h3>
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
                    <h3 class="secondry-title">Product Inventory.</h3>
                </div>
                @if($subCategory && $subCategory->category && $subCategory->category->has_size == 1)
                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">Product Size (optional)</label>
                        <input type="text" class="form-control" id="formInput25"  name="size">
                    </div>

                </div>
                @endif


                @if($subCategory && $subCategory->category && $subCategory->category->has_color == 1)

                <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">Product Color (optional)</label>
                        <input type="text" name="color"   class="form-control">
                    </div>

                </div>

@endif
                 <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">Product Sku</label>
                        <input type="text" name="sku" required  class="form-control">
                    </div>

                </div>
             <div class="col-md-6">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">Product Amount</label>
                        <input type="number" min="1" name="amount" required  class="form-control">
                    </div>

                </div>
                <input type="hidden" name="product_id" value="{{$productId}}">
                 @if($subCategory && $subCategory->category && $subCategory->category->has_brand == 1)
                  <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">Product Brand</label>
                       <select class="form-control select2" name="brand_id">
                           @foreach($brands as $brand)
                           <option value="{{$brand->id}}">{{$brand->name}}</option>
                           @endforeach
                       </select>
                    </div>

                </div>
                @endif


                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">Note</label>
                        <textarea  name="note" required class="form-control autogrow" rows="5" cols="5" >{{ old('note') }}</textarea>
                    </div>
                </div>


                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
            </form>
            {{--     <div class="col-md-3">
                <div class="form-group margin-bottom20">
                    <label class="control-label" for="formInput25">Picture</label>
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
                    <th>Product Name</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Sku</th>
                    <th>Amount</th>
                    <th>Action</th>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script type="text/javascript" src="{{ asset('assets/panel-assets/js/jquery-1.11.1.min.js') }}"></script>
<script type="text/javascript">
$(".select2").select2();


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
                    <td>`+data['color']+`</td>
                    <td>`+data['sku']+`</td>
                    <td>`+data['amount']+`</td>
                    <td>
                          <form action="{{route('dashboard.delete.product.inventory')}}" style="display: inline-block" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="`+data['id']+`">
                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                    </td>
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
