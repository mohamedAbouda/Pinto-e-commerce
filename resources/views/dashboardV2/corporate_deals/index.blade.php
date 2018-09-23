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
            {{ trans('web.dashboard_corporate_deals_pages_index_page_section_header_corporate_deals') }}
        </h3>
    </div>
    <div class="col-xs-4 col-md-3">
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
             
                <li>
                    <a href="{{route('dashboard.active.corporate_deals')}}">Active Deals</a>
                </li>
                  <li>
                    <a href="{{route('dashboard.notActive.corporate_deals')}}">Not Active Deals</a>
                </li>
               
            </ul>
        </div>
    </div>
    <div class="col-md-11 col-md-offset-1 text-right col-xs-11">
        <a class="btn btn-blue margin-left-10" href="{{route('dashboard.corporate_deals.create')}}">
            <span>+ </span>
            {{ trans('web.dashboard_corporate_deals_pages_index_page_add_new_corporate_deal') }}
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
                        <h5 class="customer-stat-text pad5">
                            {{ trans('web.dashboard_corporate_deals_pages_index_page_total_corporate_deals_count') }}
                        </h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">{{count($corporate_deals)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10">
            {{ $corporate_deals->links() }}
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15">
            <table class="table table-borderless table-responsive">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('web.dashboard_corporate_deals_pages_index_page_table_header_first_product') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_corporate_deals_pages_index_page_table_header_second_product') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_corporate_deals_pages_index_page_table_header_discount') }}
                        </th>

                        <th>
                            {{ trans('web.dashboard_corporate_deals_pages_index_page_table_header_action') }}
                        </th>
                    </tr>
                    @foreach($corporate_deals as $corporate_deal)
                    <tr>
                        <td>
                            {{$corporate_deal->firstProduct->name}}
                        </td>
                        <td>
                            {{$corporate_deal->secondProduct->name}}
                        </td>

                        <td>
                            {{$corporate_deal->discount}}
                        </td>

                        <td>
                            <a href="{{url('dashboard/corporate_deals/'.$corporate_deal->id.'/edit')}}"
                                class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                title="{{ trans('web.dashboard_branches_pages_index_page_edit_button') }}"><i class="fa fa-edit"></i></a>
                                {{ Form::open(['route' => ['dashboard.corporate_deals.destroy',$corporate_deal->id ],'method'=>'delete']) }}
                                <button
                                class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                title="{{ trans('web.dashboard_branches_pages_index_page_delete_button') }}">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            {{ Form::close() }}
                            @if(!Auth::guard('merchant')->check())
                                @if($corporate_deal->approved == 0)
                                    <form action="{{route('dashboard.toggle.status.corporate_deals')}}" method="post">
                                       {{csrf_field()}}
                                       <input type="hidden" name="id" value="{{$corporate_deal->id}}">
                                       <input type="submit" value="Approve" class="btn btn-primary">
                                    </form>
                                @else
                                 <form action="{{route('dashboard.toggle.status.corporate_deals')}}" method="post">
                                       {{csrf_field()}}
                                       <input type="hidden" name="id" value="{{$corporate_deal->id}}">
                                       <input type="submit" value="Disapprove" class="btn btn-danger">
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
