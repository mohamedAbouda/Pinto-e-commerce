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
        <h3 class="section-title contacts-section-title">{{trans('web.dashboard_orders_pages_index_orders')}} </h3>
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

        <div class="btn-group">
            <button type="button" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-ellipsis-h"></i>
            </button>
            <ul class="dropdown-menu contact-dropdown pull-right" role="menu">
              @if(Auth::guard('merchant')->check())
               <li>
                    <a href="{{route('dashboard.merchant.active.orders')}}">{{trans('web.dashboard_orders_pages_index_active_orders')}}</a>
                </li>
                  <li>
                    <a href="{{route('dashboard.merchant.history.orders')}}">{{trans('web.dashboard_orders_pages_index_history_orders')}}</a>
                </li>
              @else
                <li>
                    <a href="{{route('dashboard.active.orders')}}">{{trans('web.dashboard_orders_pages_index_active_orders')}}</a>
                </li>
                  <li>
                    <a href="{{route('dashboard.history.orders')}}">{{trans('web.dashboard_orders_pages_index_history_orders')}}</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3 margin-bottom10 margin-top20">
                <div class="total-customer-col pad5 pad-bottom5 col-md-12">
                    <div class="col-md-9 customer-stat-col-pad">
                        <h5 class="customer-stat-text pad5">{{trans('web.dashboard_orders_pages_index_total_orders')}}</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">{{count($orders)}}</h5>
                    </div>
                </div>
            </div>
            {{ Form::open(['id' => 'filter' , 'method' => 'GET']) }}
            <div class="col-md-3 sort-col col-xs-5">
                <h3 class="section-details margin-top15">{{trans('web.dashboard_orders_pages_index_search')}} :
                    <span class="black">
                        <div class="btn-group margin-top0 pad0">
                            <input type="text" name="search" class="form-control" value="{{ old('search') }}">
                        </div>
                    </span>
                </h3>
            </div>
            <div class="col-md-5 contact-edit-col col-xs-4">
                <div class="col-xs-4 col-md-4">
                    <select class="form-control" name="status" style="margin-top:15px;margin-bottom:15px;">
                        <option disabled {{ !request()->get('status') ? 'selected' : '' }}>Status : </option>
                        <option value="1" {{ request()->get('status') == 1 ? 'selected' : '' }}>Submitted</option>
                        <option value="2" {{ request()->get('status') == 2 ? 'selected' : '' }}>Confirmed</option>
                        <option value="3" {{ request()->get('status') == 3 ? 'selected' : '' }}>Cancelled</option>
                        <option value="4" {{ request()->get('status') == 4 ? 'selected' : '' }}>In Progress</option>
                        <option value="5" {{ request()->get('status') == 5 ? 'selected' : '' }}>Processed</option>
                        <option value="6" {{ request()->get('status') == 6 ? 'selected' : '' }}>Delivered</option>
                        <option value="7" {{ request()->get('status') == 7 ? 'selected' : '' }}>Reviewed</option>
                        <option value="8" {{ request()->get('status') == 8 ? 'selected' : '' }}>Dispute Not Delivered</option>
                        <option value="9" {{ request()->get('status') == 9 ? 'selected' : '' }}>Dispute Wrong Order</option>
                        <option value="10" {{ request()->get('status') == 10 ? 'selected' : '' }}>Dispute Bad Product</option>
                        <option value="11" {{ request()->get('status') == 11 ? 'selected' : '' }}>Dispute Other</option>
                    </select>
                </div>
                @if(!Auth::guard('merchant')->check())
                <div class="col-xs-4 col-md-4">
                    @if(isset($merchants))
                    {{ Form::select('merchant_id',$merchants,old('merchant_id'),['class' => "form-control", 'style' => "margin-top:15px;margin-bottom:15px;",'placeholder'=>'select a merchant']) }}
                    @endif
                </div>
                @endif
                <div class="col-xs-2 col-md-2">
                    <button type="button" class="btn btn-sm edit-btn text-center" id="orderbtn">
                        <i class="fa fa-long-arrow-{{ request()->get('orderBy','ASC') === 'ASC' ? 'up' : 'down' }}"></i>
                    </button>
                    <input type="hidden" name="orderBy" value="{{ request()->get('orderBy','ASC') }}">
                </div>
                <div class="col-xs-2 col-md-2">
                    <button type="submit" class="btn btn-white-blue">
                        <i class="fa fa-filter"></i>Filter
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10" id="pagination-links">
            @include('dashboardV2.orders.parts.links')
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15">
            <table class="table table-borderless table-responsive">
                <thead>
                    <tr>

                        <th>
                          {{trans('web.dashboard_orders_pages_index_client_name')}}
                        </th>
                        <th>
                            {{trans('web.dashboard_orders_pages_index_stauts')}}
                        </th>
                        <th>

                            {{trans('web.dashboard_orders_pages_index_dispute_request')}}
                        </th>
                         <th>

                           {{trans('web.dashboard_orders_pages_index_change_status')}}
                        </th>

                        <th>
                            {{trans('web.dashboard_orders_pages_index_action')}}
                        </th>
                    </tr>


                </thead>
                <tbody id="bodyTable">
                    @include('dashboardV2.orders.parts.table')
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
            if(data.status == 1){
                statusText = 'Submitted';
            }else if(data.status ==2){
                statusText = 'Confirmed';
            }else if(data.status ==3){
                statusText = 'Cancelled';
            }else if(data.status ==4){
                statusText = 'In Progress';
            }else if(data.status ==5){
                statusText = 'Processed';
            }else if(data.status ==6){
                statusText = 'Delivered';
            }else if(data.status ==7){
                statusText = 'Reviewed';
            }else if(data.status ==8){
                statusText = 'Dispute Not Delivered';
            }else if(data.status ==9){
                statusText = 'Dispute Wrong Order';
            }else if(data.status ==10){
                statusText = 'Dispute Bad Product';
            }else if(data.status ==11){
                statusText = 'Dispute Other';
            }else{
                statusText = 'Undefiend';
            }
            $('#order'+data.id).empty();
            $('#order'+data.id).text(statusText);
        },
        error : function(data){

        }
    },"json");
});

$('#orderbtn').click(function(e){
    e.preventDefault();
    var input = $(this).parent().find('input');
    var value = input.val();
    if (value == 'ASC') {
        $(this).find('i').removeClass('fa-long-arrow-up').addClass('fa-long-arrow-down');
        input.val('DESC');
    }else{
        $(this).find('i').removeClass('fa-long-arrow-down').addClass('fa-long-arrow-up');
        input.val('ASC');
    }
});

// $('#filter').submit(function(e){
//     e.preventDefault();
//     var form_data = $(this).serialize();
//     $.ajax({
//         type: "GET",
//         url : "{{ route('dashboard.orders.index') }}",
//         data : form_data,
//         dataType : 'json',
//         success : function(response){
//             if (typeof response.table != 'undefined') {
//                 $('#bodyTable').html(response.table);
//             }
//             if (typeof response.links != 'undefined') {
//                 $('#pagination-links').html(response.links);
//             }
//         }
//     });
// });
</script>
@stop
