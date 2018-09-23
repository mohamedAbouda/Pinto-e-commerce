@extends('layouts.dashboard.app')

@section('stylesheets')
{{ Html::style('assets/panel-assets/plugins/datetimepicker/jquery.datetimepicker.css') }}
<style>
body {
    background-color:#edeff9;
}
.btn-disable
{
    cursor: not-allowed;
    pointer-events: none;

    /*Button disabled - CSS color class*/
    color: #c0c0c0;
    background-color: white;

}
</style>
{{ Html::style('assets/panel-assets/plugins/select2/dist/css/select2.min.css') }}
<style>
.select2-selection {
    width: 100%;
    height: 40px !important;
    line-height: 1.467 !important;
    padding: 8px 12px !important;
    font-size: 14px;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.select2-selection__arrow {
    margin-top: 6px;
}
</style>
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_products_index_product') }} </h3>
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
        <a class="btn btn-blue margin-left-10" href="{{route('dashboard.products.create')}}">
            <span>+ </span>{{ trans('web.dashboard_products_index_add') }}
        </a>

        <div class="btn-group">
            <button type="button" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-ellipsis-h"></i>
            </button>
            <ul class="dropdown-menu contact-dropdown pull-right" role="menu">

                <li>
                    <a href="{{route('dashboard.products.featured.products')}}">{{ trans('web.dashboard_products_index_feat') }}</a>
                </li>
                <li>
                    <a href="{{route('dashboard.show.approved.products')}}">{{ trans('web.dashboard_products_index_app') }}</a>
                </li>
                <li>
                    <a href="{{route('dashboard.show.disapproved.products')}}">{{ trans('web.dashboard_products_index_dis') }}</a>
                </li>
                 <li>
                    <a href="{{route('dashboard.with.correlation.products')}}">{{trans('web.dashboard_products_with_correlation')}}</a>
                </li>
                 <li>
                    <a href="{{route('dashboard.without.correlation.products')}}">{{trans('web.dashboard_products_without_correlation')}}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-4 margin-bottom10 margin-top20">
                <div class="total-customer-col pad5 pad-bottom5 col-md-12">
                    <div class="col-md-9 customer-stat-col-pad">
                        <h5 class="customer-stat-text pad5">{{ trans('web.dashboard_products_index_tot') }}</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">{{count($products)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row margin-top15">
    <div class="col-md-9">
        <div class="row margin-bottom10">
            {{ $products->links() }}
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15">
            <table class="table table-borderless table-responsive">
                <tbody>
                    <tr>

                        <th>
                            {{ trans('web.dashboard_products_index_name') }}
                        </th>

                        <th>
                            {{ trans('web.dashboard_products_index_ava') }}
                        </th>

                        <th>
                            {{ trans('web.dashboard_products_index_act') }}
                        </th>
                    </tr>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>
                            @if($product->stocks->sum('amount') > 0)
                            {{ trans('web.dashboard_products_index_avali') }}
                            @else
                            {{ trans('web.dashboard_products_index_not') }}
                            @endif
                        </td>

                        <td>
                            <a href="{{url('dashboard/products/'.$product->id.'/edit')}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

                            <a href="{{url('dashboard/products/'.$product->id.'/show')}}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa fa-eye"></i></a>

                            <a href="{{url('dashboard/products/'.$product->id.'/destroy')}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="fa fa-trash-o"></i>
                            </a>
                            @include('dashboardV2.products.featured')
                            <a href="{{url('dashboard/products/'.$product->id.'/reviews')}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Reviews">
                                <i class="fa fa-eye"></i> {{ trans('web.dashboard_products_index_rev') }}
                            </a>
                            @if($product->approved == 1)
                            {{ Form::open(['route' => 'dashboard.admin.toggle.approve']) }}
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <button type="submit" class="btn btn-danger">{{ trans('web.dashboard_products_index_disapprove') }}</button>
                            {{ Form::close() }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-3">
        <div class="row margin-bottom10">
        </div>
        {{ Form::open(['id' => 'filter-products-form' ,'method' => 'GET']) }}
        <div class="form-group margin-bottom10">
            <input name="from" type="text" value="{{ request('from' ,NULL) }}" class="form-control" placeholder="From">
        </div>
        <div class="form-group margin-bottom10">
            <input name="to" type="text" value="{{ request('to' ,NULL) }}" class="form-control" placeholder="To">
        </div>
        <div class="form-group margin-bottom10">
            <button type="submit" class="btn btn-primary btn-sm" style="width:100%;">
                filter
            </button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@stop

@section('scripts')
{{ Html::script('assets/panel-assets/plugins/datetimepicker/build/jquery.datetimepicker.full.min.js') }}
{{ Html::script('assets/panel-assets/plugins/select2/dist/js/select2.full.min.js') }}

<script type="text/javascript">
$(document).ready(function(){
    $('select').select2();
    $('input[name=from]').datetimepicker({
        format:'Y-m-d H:i:s'
    });
    $('input[name=to]').datetimepicker({
        format:'Y-m-d H:i:s'
    });

    $('#filter-products-form input,#filter-products-form select').change(function(){
        $(this).parents('form').submit();
    });
});
</script>
@stop
