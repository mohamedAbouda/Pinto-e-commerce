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
            {{ trans('web.dashboard_gift_cards_pages_index_page_section_header_gift_cards') }}
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
                        <h5 class="customer-stat-text pad5">{{ trans('web.dashboard_gift_cards_pages_index_page_total_gift_cards_count') }}</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">{{count($gift_cards)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10">
            {{ $gift_cards->links() }}
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15">
            <table class="table table-borderless table-responsive">
                <tbody>
                    <tr>

                        <th>
                            {{ trans('web.dashboard_gift_cards_pages_index_page_table_header_name') }}
                        </th>

                        <th>
                            {{ trans('web.dashboard_gift_cards_pages_index_page_table_header_action') }}
                        </th>
                    </tr>
                    @foreach($gift_cards as $gift_card)
                    <tr>
                        <td>
                            {{$gift_card->name}}
                        </td>
                        <td>
                            {{ Form::open(['route' => ['dashboard.gift_cards.destroy',$gift_card->id ],'method'=>'delete']) }}
                            <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('web.dashboard_branches_pages_index_page_delete_button') }}">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            {{ Form::close() }}
                            @if($gift_card->is_active == 1)
                            {{ Form::open(['route' => ['dashboard.giftCard.change.status'],'method'=>'post']) }}
                            <input type="hidden" name="gift_id" value="{{$gift_card->id}}">
                            <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('web.dashboard_gift_cards_pages_index_page_table_not_active') }}">
                                {{ trans('web.dashboard_gift_cards_pages_index_page_table_not_active') }}
                            </button>
                            {{ Form::close() }}
                            @else
                            {{ Form::open(['route' => ['dashboard.giftCard.change.status'],'method'=>'post']) }}
                            <input type="hidden" name="gift_id" value="{{$gift_card->id}}">
                            <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('web.dashboard_gift_cards_pages_index_page_table_active') }}">
                                {{ trans('web.dashboard_gift_cards_pages_index_page_table_active') }}
                            </button>
                            {{ Form::close() }}
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
