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
           Coupons
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
        <a class="btn btn-blue margin-left-10" href="{{route('dashboard.coupons.create')}}">
            <span>+ </span>Add Coupon
        </a>

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
                        <h5 class="customer-stat-text pad5">Total Coupon Count</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">{{count($coupons)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10">
            {{ $coupons->links() }}
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15">
            <table class="table table-borderless table-responsive">
                <tbody>
                    <tr>

                        <th>
                           Code
                        </th>
                        <th>
                           Discount 
                        </th>


                        <th>
                           Action
                        </th>
                    </tr>
                    @foreach($coupons as $coupon)
                    <tr>
                        <td>
                            {{$coupon->code}}
                        </td>
                        <td>
                             @if($coupon->percentage < 1)
                             {{$coupon->percentage *100}} %
                             @else
                             {{$coupon->percentage}} L.E
                             @endif
                            
                        </td>
                        <td>
                            <a href="{{ route('dashboard.coupons.edit' , [ $coupon->id ]) }}"
                                class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                title="{{ trans('web.dashboard_branches_pages_index_page_edit_button') }}">
                                <i class="fa fa-edit"></i>
                            </a>

                            {{ Form::open(['route' => ['dashboard.coupons.destroy',$coupon->id ],'method'=>'delete']) }}
                            <button
                            class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                            title="{{ trans('web.dashboard_branches_pages_index_page_delete_button') }}">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@stop
