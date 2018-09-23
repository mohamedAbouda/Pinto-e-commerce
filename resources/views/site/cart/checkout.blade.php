@extends('layouts.site.app')
@section('stylesheets')
@endsection
@section('content')
    <section class="shopping-cart">
      <form action="{{route('web.cart.checkout.submit')}}" method="post">
          {{ csrf_field() }}
            <!-- .shopping-cart -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Check Out</li>
                    </ol>
                </div>
                    <div class="col-md-12">
                    <!-- Accordions -->
               <div class="tabContent" id="tabContent1">
                 
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 class="panel-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">01 Shipping Information</a>
                        </h4>
                     </div>
                     <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                           <div class="shipping-outer">
                           
                           
                              
                  
                              <div class="col-sm-12 col-md-12">
                                 <div class="lable">Address</div>
                                 <input name="address" placeholder="Address" type="text">                               
                              </div>
                          
                              <div class="col-sm-4 col-md-6">
                                 <div class="lable">Country</div>
                                 <div class="size State">
                                 <input name="country" placeholder="country" type="text">
                                 </div>
                              </div>
                                <div class="col-sm-4 col-md-6">
                                 <div class="lable">City</div>
                                 <div class="size State">
                                 <input name="city" placeholder="city" type="text">
                                 </div>
                              </div>
                          
                         
                              <div class="col-sm-4 col-md-12">
                                 <div class="lable">Telephone</div>
                                 <input name="phone" placeholder="phone" type="text">                                                       
                              </div>
                              
                           
                            <!--   <div class="col-sm-12 col-md-12">    
                               <input name="use_for_shipping" value="" class="radio" type="radio">
                               <label class="label-radio">Ship to this address</label>
                               <input name="use_for_shipping" value="" class="radio" type="radio">
                               <label class="label-radio">Ship to different address</label>
                            </div> -->
                             
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
    
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">02 Payment Information</a>
                     </h4>
                  </div>
                  <div id="collapse5" class="panel-collapse collapse">
                     <div class="panel-body">
                        <div class="shipping-outer">
                           <div class="col-sm-12 col-md-12">    
                              <input name="use_for_shipping" value="" class="radio" type="radio">
                              <label class="label-radio">Credit Card</label>
                           </div>
                           <div class="col-sm-12 col-md-12">  
                              <input name="use_for_shipping" value="" class="radio" type="radio">
                              <label class="label-radio">Cash on Delivery </label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">03 Order Review & Gift Card</a>
                     </h4>
                  </div>
                  <div id="collapse6" class="panel-collapse collapse">
                     <div class="panel-body">
                        <div id="checkout-step-review" class="step a-item" style="">
                           <div class="order-review" id="checkout-review-load">
                              <div id="checkout-review-table-wrapper">
                                 <table class="data-table linearize-table checkout-review-table" id="checkout-review-table">
                                    <thead>
                                       <tr class="first last">
                                          <th rowspan="1">Product</th>
                                          <th colspan="1" class="a-center">Price</th>
                                          <th rowspan="1" class="a-center">Qty</th>
                                          <th colspan="1" class="a-center">Subtotal</th>
                                       </tr>
                                    </thead>
                                       <tbody>
                                          <input type="hidden" name="total_price_after_discount" value="{{$total}}">
                                          <input type="hidden" name="total_price" value="{{$cartSubTotal}}">
                                          @foreach($cartItems as $cartItem)
                                           <tr class="first last odd">
                                          <td>
                                             <h3 class="product-name">{{$cartItem->name}} </h3>
                                         
                                          </td>
                                          <td class="a-right" data-rwd-label="Price">
                                             <span class="cart-price">
                                             <span class="price">{{$cartItem->options->obj->price}} EGP</span>            
                                             </span>
                                          </td>
                                          <td class="a-center" data-rwd-label="Qty">{{$cartItem->qty}}</td>
                                          <!-- sub total starts here -->
                                          <td class="a-right last" data-rwd-label="Subtotal">
                                             <span class="cart-price">
                                             <span class="price">{{$cartItem->options->obj->price * $cartItem->qty}} EGP</span>            
                                             </span>
                                          </td>
                                       </tr>
                                       @endforeach
                                   
                                           <tr class="first">
                                          <td style="" class="a-right" colspan="3">
                                             {!! $string !!}   
                                          </td>
                                          <td style="" class="a-right last">
                                             <span class="price">{{$total}} EGP</span>    
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="" class="a-right" colspan="3">
                                             Shipping &amp; Handling (Flat Rate - Fixed)    
                                          </td>
                                          <td style="" class="a-right last">
                                             <span class="price">EGP 5.00</span>    
                                          </td>
                                       </tr>
                                       <tr class="last">
                                          <td style="" class="a-right" colspan="3">
                                             <strong>Grand Total</strong>
                                          </td>
                                          <td style="" class="a-right last">
                                             <strong><span class="price">{{$total}} EGP</span></strong>
                                          </td>
                                       </tr>
                                       </tbody></table>
                                   <div class="shipping-outer" style="margin-top:0px;margin-bottom:0px;">
                                        <div class="col-sm-12 col-md-12">    
                                        <input name="use_for_shipping" value="" class="radio" type="checkbox">
                                        <label class="label-radio"><b>Request Preview</label>
                                    </div>
                                    
                                    </div>
                                       </div>
                                          </div>
                                 
                              <div id="checkout-review-submit">
                                 <div class="buttons-set" id="review-buttons-container">
                                    <button type="submit" title="Place Order" class="button btn-checkout">Place Order</button>            
                                   
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
                    </div>
                </div>
               
            </div>
      <!-- /.shopping-cart -->
   </form>
      </section>
@endsection
@section('scripts')
<script type="text/javascript">
 
</script>
@endsection