@extends('layouts.site.app')
@section('stylesheets')
@endsection
@section('content')
  <section class="shopping-cart">
        <!-- .shopping-cart -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Library</li>
                    </ol>
                </div>
                <div class="col-md-12">
                    <h2>You cart items</h2>
                    <table>
                        <tr>
                            <th></th>
                            <th>Product name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th></th>
                        </tr>
                        @foreach($cart as $cartItem)
                        <tr class="cartContent{{$cartItem->rowId}}">
                           
                                <input type="hidden" id="rowId" name="rowId" value="{{$cartItem->rowId}}">
                            <td>
                                <img src="{{$cartItem->options->obj->cover_image_url}}" style="max-width: 100px;max-height: 100px;">
                            </td>
                            <td>{{$cartItem->name}}</td>
                            <td>{{$cartItem->options->obj->short_description}}</td>
                            <td>
                                <strong>{{$cartItem->price}}</strong>
                            </td>
                            <td>
                                <input type="number" id="number{{$cartItem->rowId}}" onchange="changeQty('{{$cartItem->rowId}}')" value="{{$cartItem->qty}}" min="1">
                            </td>
                            <td>
                                <strong id="item{{$cartItem->rowId}}">{{$cartItem->subtotal}} EGP</strong>
                            </td>
                            <td>
                                <span class="red" onclick="removeCartItem('{{$cartItem->rowId}}')">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                   
                    </table>
                    <div class="col-sm-6 col-md-6">
                        <a href="{{route('index')}}" class="button red">CONTINUE SHOPPING</a>
                    </div>
                    <div class="col-sm-6 col-md-6 text-right">
                        <a href="#" onclick="updatePage()" class="button">UPDATE SHOPPING CART</a>
                        <a href="{{route('web.cart.destroy')}}" class="button">CLEAR SHOPPING CART</a>
                    </div>
                                                    <div class="col-md-6">
                        <div class="shipping-outer">
                           <form action="{{route('web.cart.add.coupon.save')}}" method="post" id="couponFormAjax">
                                {{ csrf_field() }}
                            <h2>Coupon code</h2>
                            <div class="row">

                                <div class="col-md-12">
                                
                                    <div class="lable">Coupon Code:</div>
                                    <input name="code" placeholder="Coupon Code" type="text">
                                    <p style="color: red" id="couponMessage"></p>
                                </div>
                            </div>
                           <input type="submit" value="REdeem code" name="REdeem code" class="btn btn-primary">
                         </form>
                        </div>
                    </div>
                    
                    <div class=" pull-right col-md-4">
                        <div class="shipping-outer">
                            <h2>Cart totals</h2>
                            <ul>
                                <li>Cart Subtotal:
                                    <strong class="price-total">{{$total}} EGP</strong>
                                </li>
                                <li>Shipping and Handling:
                                    <strong>$10.00</strong>
                                </li>
                                <li>Cart Totals:
                                    <strong class="price-total">{{$total}} EGP</strong>
                                </li>
                                <li class="text-center">
                                    <a href="{{route('web.cart.checkout')}}" class="redbutton">Proceed to checkout</a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.shopping-cart -->
    </section>
@endsection
@section('scripts')
<script type="text/javascript">
        function updatePage() {
        location.reload();
    }

  function changeQty(id) {
        var rowId = id;
        var qty = $('#number'+rowId).val();
       $.ajax({
    type: "POST",

    url: "{{route('web.cart.update.item.qty')}}",
    data: {
         _token: "{{ csrf_token() }}",
        rowId: rowId,
        qty:qty,
    },
    success: function(data) {
        console.log(data);
        $('#item'+data[0]['rowId']).text(data[0]['qty'] * data[0]['price']+' EGP');
        $('.price-total').text(data[1]+' EGP');
    }
});
    }
     $('#couponFormAjax').submit(function(e){
    e.preventDefault();
    var form = jQuery('#couponFormAjax');
        var dataString = form.serialize();
        var formAction = form.attr('action');
        $.ajax({


          type: "POST",
          url : formAction,
          data : dataString,
          success : function(data){
            
            $('#couponMessage').text('');
            $('#couponMessage').text(data);
          },
          error : function(data){
           
          }

        },"json");
});
</script>
@endsection