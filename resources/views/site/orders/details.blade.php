@extends('layouts.site.app')
@section('content')
<div class="main-content space-padding-tb-70">
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="text-center" style="margin-bottom:20px;">
                    <h3>Order details</h3>
                </div>
                <table class="table">
                    <tbody>
                        <tr class="first">
                            <td style="text-align:left;" colspan="3">
                                Subtotal
                            </td>
                            <td style="text-align:right;">
                                <span class="price">EGP {{ $order->total_price }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:left;" colspan="3">
                                Shipping &amp; Handling (Flat Rate - Fixed)
                            </td>
                            <td style="text-align:right;">
                                <span class="price">EGP 5.00</span>
                            </td>
                        </tr>
                        <tr class="last">
                            <td style="text-align:left;" colspan="3">
                                Grand Total
                            </td>
                            <td style="text-align:right;">
                                <strong><span class="price">EGP {{ $order->total_price }}</span></strong>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                        <tr>
                            @foreach($order->items as $item)
                            <td style="text-align:left;">
                                <h5>{{ $item->product->name }}</h5>
                                <dl class="item-options">
                                    <dt>Color</dt>
                                    <dd>{{ $item->color ? $item->color :'None' }}</dd>
                                    <dt>Size</dt>
                                    <dd>{{ $item->size ? $item->size :'None' }}</dd>
                                </dl>
                            </td>
                            <td class="text-center" data-rwd-label="Price">
                                <span class="cart-price">
                                    <span class="price">EGP {{ $item->product->price }}</span>
                                </span>
                            </td>
                            <td class="text-center" data-rwd-label="Qty">{{ $item->amount }}</td>
                            <td class="text-center" data-rwd-label="Subtotal">
                                <span class="cart-price">
                                    <span class="price">EGP {{ $item->product->price * $item->amount }}</span>
                                </span>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                <strong>
                                    Details
                                </strong>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="first">
                            <td><strong>Name</strong></td>
                            <td style="">
                                <span class="">{{ $order->user->name }}</span>
                            </td>
                        </tr>
                        <tr class="first">
                            <td><strong>Street Adress</strong></td>
                            <td style="">
                                <span class="">{{ $order->user->address ? $order->user->address->address : 'None' }}</span>
                            </td>
                        </tr>
                        <tr class="first">
                            <td><strong> City</strong></td>
                            <td style="">
                                <span class="">{{ $order->user->address ? $order->user->address->city : 'None' }}</span>
                            </td>
                        </tr>
                        <tr class="first">
                            <td><strong>State / County</strong></td>
                            <td style="">
                                <span class="">{{ $order->user->address ? $order->user->address->country : 'None' }}</span>
                            </td>
                        </tr>
                        <tr class="first">
                            <td><strong>Phone</strong></td>
                            <td style="">
                                <span class="">{{ $order->user->address ? $order->user->address->phone : 'None' }}</span>
                            </td>
                        </tr>
                        <tr class="first">
                            <td><strong>Order Notes</strong></td>
                            <td style="">
                                <span class="">{{ $order->note }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
