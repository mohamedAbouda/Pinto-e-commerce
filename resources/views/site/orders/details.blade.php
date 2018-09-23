@extends('layouts.site.app')
@section('stylesheets')
@endsection
@section('content')
<section >
    <div class="container" >
      <div class="row">
        <div class="col-md-12">
          <div id="checkout-review-table-wrapper" class="col-md-12 text-center">
                <table class="data-table linearize-table checkout-review-table" id="checkout-review-table" style="width:100%; margin-top:90px;margin-bottom:90px;">
                  <thead>
                    <tr class="first last">
                      <th rowspan="1">Product</th>
                      <th colspan="1" class="a-center">Price</th>
                      <th rowspan="1" class="a-center">Qty</th>
                      <th colspan="1" class="a-center">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="first">
                      <td style="" class="a-right" colspan="3">
                        Subtotal
                      </td>
                      <td style="" class="a-right last">
                        <span class="price">EGP {{$order->total_price}}</span>
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
                        <strong><span class="price">EGP {{$order->total_price}}</span></strong>
                      </td>
                    </tr>
                    <tr class="first last odd">
                    
                      @foreach($order->items as $item)
                      <td>
                        <h3 class="product-name">{{$item->product->name}} </h3>
                        <dl class="item-options">
                          <dt>Color</dt>
                          <dd>{{$item->color ? $item->color :'None'}}</dd>
                          <dt>Size</dt>
                          <dd>{{$item->size ? $item->size :'None'}}</dd>

                        </dl>
                      </td>
                      @endforeach
                      <td class="a-right" data-rwd-label="Price">
                        <span class="cart-price">
                                             <span class="price">EGP {{$item->product->price}}</span>
                        </span>
                      </td>
                      <td class="a-center" data-rwd-label="Qty">{{$item->amount}}</td>
                      <!-- sub total starts here -->
                      <td class="a-right last" data-rwd-label="Subtotal">
                        <span class="cart-price">
                                             <span class="price">EGP {{$item->product->price * $item->amount}}</span>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
            <table class="data-table linearize-table checkout-review-table" id="checkout-review-table" style="width:100%;margin-bottom:90px;margin-top:40px;">
                  <thead>
                    <tr class="first last">
                      <th rowspan="1" class="a-center"></th>
                      <th rowspan="1">Details</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="first">
                      <td rowspan="1"><strong>Name</strong></td>
                      <td style="" class="a-right">
                        <span class="">{{$order->user->name}}</span>
                      </td>
                    </tr>
                  
                    <tr class="first">
                      <td rowspan="1"><strong>Street Adress</strong></td>
                      <td style="" class="a-right">
                        <span class="">{{$order->user->address ? $order->user->address->address : 'None'}}</span>
                      </td>
                    </tr>
                    <tr class="first">
                      <td rowspan="1"><strong> City</strong></td>
                      <td style="" class="a-right">
                        <span class="">{{$order->user->address ? $order->user->address->city : 'None'}}</span>
                      </td>
                    </tr>
                    <tr class="first">
                      <td rowspan="1"><strong>State / County</strong></td>
                      <td style="" class="a-right">
                        <span class="">{{$order->user->address ? $order->user->address->country : 'None'}}</span>
                      </td>
                    </tr>
                    <tr class="first">
                      <td rowspan="1"><strong>Phone</strong></td>
                      <td style="" class="a-right">
                        <span class="">{{$order->user->address ? $order->user->address->phone : 'None'}}</span>
                      </td>
                    </tr>
                    <tr class="first">
                      <td rowspan="1"><strong>Order Notes</strong></td>
                      <td style="" class="a-right">
                        <span class="">{{$order->note}}</span>
                      </td>
                    </tr>
                    </tbody>
                </table>
                
                </div>
              </div>
            
        </div>
      
    </div>
  </section>
@endsection
@section('scripts')
@endsection