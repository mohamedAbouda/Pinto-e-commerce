
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
            ({{ $product->name }}){{ trans('web.dashboard_products_show_data') }}.
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
    <div class="col-md-4 col-md-offset-1 text-right col-xs-11">
        @if(Auth::guard('merchant')->check())
        <a href="{{ route('dashboard.products.create') }}"class="btn btn-primary margin-left-10">
            <span>+ </span>{{ trans('web.dashboard_products_show_add') }}
        </a>
        @endif
        <a href="{{ route('dashboard.products.edit',$product->id) }}"class="btn btn-warning margin-left-10">
            {{ trans('web.dashboard_products_show_edit') }}
        </a>
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
                                {{ trans('web.dashboard_products_show_prop') }}
                            </span>
                        </th>
                        <th>
                            {{ trans('web.dashboard_products_show_value') }}
                        </th>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_show_id') }}
                            </span>
                        </td>
                        <td>
                            {{ $product->id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_show_name') }}
                            </span>
                        </td>
                        <td>
                            {{ $product->name }}
                        </td>
                    </tr>
                      <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_show_sku') }}
                            </span>
                        </td>
                        <td>
                            {{ $product->sku }}
                        </td>
                    </tr>
                      <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_show_price') }}
                            </span>
                        </td>
                        <td>
                            {{ $product->price }}
                        </td>
                    </tr>
                      <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_show_category') }}
                            </span>
                        </td>
                        <td>
                            @if($product->subcategory)
                            {{ $product->subcategory->name }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td> <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_show_cost') }}
                            </span></td>
                        <td>
                            @if($product->generalProduct)
                        By Merchant : {{$product->generalProduct->shipping_cost}} EGP<br>
                        @endif
                           @if($product->generalProduct)
                           @if(($product->generalProduct->shipping_category == 1))
                        By site : Yes<br>
                        @endif
                        @endif
                        </td>
                    </tr>
                 
                    @if($product->merchant)
                      <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_show_merchant') }}
                            </span>
                        </td>
                        <td>
                            {{ $product->merchant->name }}
                        </td>
                    </tr>
                    @endif
                        <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_show_discount_products') }}
                            </span>
                        </td>
                        <td>
                           @if($product->discountCount)
                            @foreach($product->discountCount as $discountproduct)
                                <strong>{{ trans('web.dashboard_products_show_count') }} : </strong>{{$discountproduct->count}}<br>
                                <strong>{{ trans('web.dashboard_products_show_discount') }} : </strong>{{$discountproduct->discount}}<br><hr>
                            @endforeach
                           @else
                           {{ trans('web.dashboard_products_show_no_discount') }}.
                           @endif
                        </td>
                    </tr>
              
                    
                         <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_show_cover') }}
                            </span>
                        </td>
                        <td>
                          <img src="{{$product->cover_image_url}}" style="width: 200px;max-width: 200px;height: 150px;max-height: 150px;">
                        </td>
                    </tr>
                      <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                 {{ trans('web.dashboard_products_show_img') }}
                            </span>
                        </td>
                        <td>
                            @foreach($product->images as $image)
                          <img src="{{$image->image_url}}" style="width: 200px;max-width: 200px;height: 150px;max-height: 150px;">
                          @endforeach
                        </td>
                    </tr>
                   
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_show_desc') }}
                            </span>
                        </td>
                        <td>
                            {!! $product->description !!}
                        </td>
                    </tr>

                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_show_stocks') }}
                            </span>
                        </td>
                        <td>
                            @if($product->stocks)
                            @foreach($product->stocks as $stock)
                               <strong>{{ trans('web.dashboard_products_show_amount') }} : </strong> {{$stock->amount}}<br>
                               <strong>{{ trans('web.dashboard_products_show_note') }} : </strong> {{$stock->note}}<br><strong><hr></strong>
                                <strong>{{ trans('web.dashboard_products_show_sk') }} : </strong>{{$stock->sku}}<br>
                                 <strong>Weight : </strong>{{$stock->weight ? $stock->weight: "Not Set"}} <br>
                               <strong>{{ trans('web.dashboard_products_show_clr') }} : </strong> {{$stock->color}}<br>
                               <strong>{{ trans('web.dashboard_products_show_brnd') }} : </strong> @if($stock->brand_id)
                               {{$stock->brand->name}}
                               @else
                               {{ trans('web.dashboard_products_show_no_brnd') }}.
                               @endif
                               <br>
                               <strong>Size : </strong> {{$stock->size}}<br>
                            @endforeach
                            @else
                            {{ trans('web.dashboard_products_show_no_data') }}.
                            @endif
                        </td>
                    </tr>
                      <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                               {{ trans('web.dashboard_products_show_total_ava') }} 
                            </span>
                        </td>
                        <td>
                            @if($product->stocks)
                           <strong> {{$product->stocks->sum('amount')}}</strong>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
