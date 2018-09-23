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
            {{ trans('web.dashboard_offers_pages_index_page_section_header_offers') }}
        </h3>
    </div>

    <div class="col-md-4 col-md-offset-1 text-right col-xs-11">
        <a href="{{ route('dashboard.offers.create') }}"class="btn btn-blue margin-left-10">
            <span>+ </span>{{ trans('web.dashboard_offers_pages_index_page_add_offer') }}
        </a>
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
                        <h5 class="customer-stat-text pad5">{{ trans('web.dashboard_offers_pages_index_page_total_offers_count') }}</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">{{ $total_resources_count }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10" id="pagination-links">
            {{ $resources->links() }}
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15">
            <table class="table table-borderless table-responsive">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            {{ trans('web.dashboard_offers_pages_index_page_table_header_product') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_offers_pages_index_page_table_header_percentage') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_offers_pages_index_page_table_header_activation_start') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_offers_pages_index_page_table_header_activation_end') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_offers_pages_index_page_table_header_status') }}
                        </th>
                        <th>
                        </th>
                    </tr>


                </thead>
                <tbody id="bodyTable">
                    @foreach($resources as $resource)
                    <tr>
                        <td class="text-center">
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $counter_offset + $loop->iteration }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->product ? $resource->product->name : '[DELETED]' }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->percentage }}%
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->activation_start }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->activation_end }}
                            </h3>
                        </td>
                        <td>
                            {{ Form::open(['route' => ['dashboard.offers.toggleActivation' , $resource->id]]) }}
                            @if($resource->active === 0)
                            <button type="submit" class="btn btn-primary" style="margin:0">
                                {{ trans('web.dashboard_offers_pages_index_page_table_button_activate') }}
                            </button>
                            @else
                            <button type="submit" class="btn btn-danger" style="margin:0">
                                {{ trans('web.dashboard_offers_pages_index_page_table_button_deactivate') }}
                            </button>
                            @endif
                            {{ Form::close() }}
                        </td>
                        @else
                        <td>
                            @if($resource->active === 1)
                            {{ trans('web.dashboard_offers_pages_index_page_table_active') }}
                            @else
                            {{ trans('web.dashboard_offers_pages_index_page_table_not_active') }}
                            @endif
                        </td>
                        <td>
                            <div class="no-shadow btn-group pull-right" style="margin:0;padding:0;">
                                <button type="button" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle contact-edit-dots-shdw pad0" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-h fa-lg edit-btn-contact-ico-color"></i>
                                </button>
                                <ul class="dropdown-menu contact-dropdown pull-right">
                                    <li>
                                        <a href="{{ route('dashboard.offers.edit', $resource->id) }}">{{ trans('web.dashboard_branches_pages_index_page_edit_button') }}</a>
                                    </li>
                                    <li>
                                        {{ Form::open(['route' => ['dashboard.offers.destroy' ,$resource->id] ,'method' => 'DELETE']) }}
                                        <button type="submit">{{ trans('web.dashboard_branches_pages_index_page_delete_button') }}</button>
                                        {{ Form::close() }}
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
