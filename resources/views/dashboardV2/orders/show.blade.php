
@extends('layouts.dashboard.app')

@section('stylesheets')
<style>
body {
    background-color:#edeff9;
}
</style>
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">
            ({{ $order->user->name }})'s {{trans('web.dashboard_orders_pages_show_order')}}
        </h3>
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
        <div class="row margin-bottom10 contacts-list-view-card pad15">
            <table class="table table-borderless table-responsive" style="">
                <tbody>
                    <tr>
                        <th class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_orders_pages_show_property')}}
                            </span>
                        </th>
                        <th>
                            {{trans('web.dashboard_orders_pages_show_value')}}
                        </th>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_orders_pages_show_id')}}
                            </span>
                        </td>
                        <td>
                            {{ $order->id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_orders_pages_show_total_price')}}
                            </span>
                        </td>
                        <td>
                            @if($order->total_price_after_discount)
                            {{ $order->total_price_after_discount }}
                            @else
                            {{ $order->total_price }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_orders_pages_show_user')}}
                            </span>
                        </td>
                        <td>
                            {{ $order->user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_orders_pages_show_status')}}
                            </span>
                        </td>
                        <td>
                            @include('dashboardV2.orders.status')
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_orders_pages_show_note')}}
                            </span>
                        </td>
                        <td>
                            {{ $order->note }}
                        </td>
                    </tr>

                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_orders_pages_show_dispute_comment')}}
                            </span>
                        </td>
                        <td>
                            {{ $order->dispute_comment }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_orders_pages_show_address')}}
                            </span>
                        </td>
                        <td>
                            @if($order->address)

                            {{$order->address}}
                           

                            @else
                            No Address Yet.
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_orders_pages_show_items')}}
                            </span>
                        </td>
                        <td>
                            @foreach($order->items as $item)
                            Product : <a href="{{url('dashboard/products/'.$item->product->id.'/show')}}">{{$item->product->name}}</a><br>
                            Count : {{$item->amount}}<br>
                            Price    : {{$item->price_per_item}}<br>
                            <hr>
                            @endforeach
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
