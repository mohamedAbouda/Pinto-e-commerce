@extends('layouts.dashboard.app')

@section('stylesheets')
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
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_products_featured_products_products') }} </h3>
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
            <span>+ </span>{{ trans('web.dashboard_products_featured_products_add') }}
        </a>
        <div class="btn-group">
            <button type="button" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-ellipsis-h"></i>
            </button>
            <ul class="dropdown-menu contact-dropdown pull-right" role="menu">

                <li>
                    <a href="{{route('dashboard.products.featured.products')}}">{{ trans('web.dashboard_products_featured_products_feat') }}</a>
                </li>
                <li>
                    <a href="{{route('dashboard.show.approved.products')}}">{{ trans('web.dashboard_products_featured_products_approve') }}</a>
                </li>
                <li>
                    <a href="{{route('dashboard.show.disapproved.products')}}">{{ trans('web.dashboard_products_featured_products_dis') }}</a>
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
                        <h5 class="customer-stat-text pad5">{{ trans('web.dashboard_products_featured_products_tot') }}</h5>
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
    <div class="col-md-12">
        <div class="row margin-bottom10">
            {{ $products->links() }}
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15">
            <table class="table table-borderless table-responsive">
                <tbody id="bodyTable">
                    <tr>

                        <th>
                            {{ trans('web.dashboard_products_featured_products_name') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_products_featured_products_feat_stat') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_products_featured_products_change') }}

                        </th>
                        <th>
                            {{ trans('web.dashboard_products_featured_products_act') }}
                        </th>
                    </tr>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            {{$product->name}}
                        </td>
                        <td id="product{{$product->id}}">
                            @include('dashboardV2.products.status')
                        </td>
                        <td>
                            <form action="{{route('dashboard.products.change.featured.status.ajax')}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <select class="form-control selectStatus" style="width: 300px" name="featured">
                                    @include('dashboardV2.products.statusSelect')
                                </select>
                            </form>
                        </td>

                        <td>
                            <a href="{{url('dashboard/products/'.$product->id.'/edit')}}"
                                class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                title="Edit"><i class="fa fa-edit"></i></a>

                                <a href="{{url('dashboard/products/'.$product->id.'/show')}}"
                                    class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                                    title="Show"><i class="fa fa-eye"></i></a>

                                    <a href="{{url('dashboard/products/'.$product->id.'/destroy')}}"
                                        class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                        title="Delete"><i class="fa fa-trash-o"></i></a>
                                        @include('dashboardV2.products.featured')
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @stop
            @section('scripts')
            <script type="text/javascript">
            $('#bodyTable').on('change','.selectStatus',function (e){
                e.preventDefault();
                var form = jQuery(this).parents('form:first');
                var dataString = form.serialize();
                var formAction = form.attr('action');
                $.ajax({
                    type: "POST",
                    url : formAction,
                    data : dataString,
                    success : function(data){
                        var statusText = '';
                        if(data.featured == 1){
                            statusText = 'Not Featured';
                        }else if(data.featured ==2){
                            statusText = 'Request Sent';
                        }else if(data.featured ==3){
                            statusText = 'Approved';
                        }else if(data.featured ==4){
                            statusText = 'Disapproved';
                        }else if(data.featured ==5){
                            statusText = 'Removed from Featured';
                        }else{
                            statusText = 'Undefiend';
                        }
                        $('#product'+data.id).empty();
                        $('#product'+data.id).text(statusText);
                    },
                    error : function(data){

                    }
                },"json");
            });
        </script>
        @stop
