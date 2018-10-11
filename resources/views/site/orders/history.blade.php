@extends('layouts.site.app')

@section('content')
<div class="main-content space-padding-tb-70">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center" style="margin-bottom:20px;">
                    <h3>Your history orders</h3>
                </div>
                <table class="table">
                    <tr>
                        <th>Dispute - <br>Click icon <br> below</th>
                        <th>Product Image</th>
                        <th>Product name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Delivery Status</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            <div class="delete text-center">
                                <a href="{{ route('web.order.submit.dispute',$order->id) }}" title=""><img src="{{ asset('assets/site/img/dispute.png') }}" alt="Send a dispute message" title="Send a dispute message"></a>
                            </div>
                        </td>
                        <td>
                            <div class="product">
                                <div class="image">
                                    @foreach($order->items as $item)
                                    @if($item->product->cover_image)
                                    <img src="{{ $item->product->cover_image_url }}"  style="max-width: 150px;max-height: 150px;">
                                    @else
                                    @foreach($item->product->images as $image)
                                    <img src="{{ $image->image_url }}">
                                    @break
                                    @endforeach
                                    @endif
                                    @break
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div>
                                    @foreach($order->items as $item)
                                    {{ $item->product->name }} ,
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('web.order.details',$order->id) }}">View Details</a>
                        </td>
                        <td>
                            <div class="price">
                                @if($order->total_price_after_discount)
                                {{ $order->total_price_after_discount }} EGP
                                @else
                                {{ $order->total_price }} EGP
                                @endif
                            </div>
                        </td>

                        <td>
                            <div class="status-product">
                                <span>
                                    @if($order->status == 2)
                                    Confirmed
                                    @elseif($order->status == 4)
                                    In Progress
                                    @elseif($order->status == 5)
                                    Processed
                                    @else
                                    Not Defiend
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('web.user.reorder') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="submit" class="btn btn-danger" value="Re order" style="backcolor: #484848">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    </div>
@stop
