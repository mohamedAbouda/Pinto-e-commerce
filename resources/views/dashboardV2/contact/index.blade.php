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
            {{ trans('web.dashboard_contact_pages_index_page_section_title_contact') }}
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
        @if(!$contact)
        <a class="btn btn-blue margin-left-10" href="{{route('dashboard.contact.create')}}">
            <span>+ </span>{{ trans('web.dashboard_contact_pages_index_page_create_button') }}
        </a>
        @else
        <a class="btn btn-blue margin-left-10" href="{{ route('dashboard.contact.edit', $contact->id) }}">
            <span>+ </span>{{ trans('web.dashboard_contact_pages_index_page_edit_button') }}
        </a>
        @endif
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-5 margin-bottom10 margin-top20">
                <div class="total-customer-col pad5 pad-bottom5 col-md-12">
                    <div class="col-md-9 customer-stat-col-pad">
                        <h5 class="customer-stat-text pad5">
                            {{ trans('web.dashboard_contact_pages_index_page_total_contact_count') }}
                        </h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">{{ $contact ? $contact->count() : 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10">

        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15">
            <table class="table table-borderless table-responsive" style="">
                @if($contact)
                <tbody>
                    <tr>
                        <th class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_pages_index_page_table_property') }}
                            </span>
                        </th>
                        <th>
                            {{ trans('web.dashboard_contact_pages_index_page_table_value') }}
                        </th>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_pages_index_page_table_email') }}
                            </span>
                        </td>
                        <td>
                            {{ $contact->email }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_pages_index_page_table_facebook') }}
                            </span>
                        </td>
                        <td>
                            {{ $contact->facebook }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_pages_index_page_table_google') }}
                            </span>
                        </td>
                        <td>
                            {{ $contact->google }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_pages_index_page_table_twitter') }}
                            </span>
                        </td>
                        <td>
                            {{ $contact->twitter }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_pages_index_page_table_instagram') }}
                            </span>
                        </td>
                        <td>
                            {{ $contact->instagram }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_pages_index_page_table_address') }}
                            </span>
                        </td>
                        <td>
                            {{ $contact->address }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_pages_index_page_table_phones') }}
                            </span>
                        </td>
                        <td>
                            <ul>
                                <?php $phones = explode(',', $contact->phones); ?>
                                <?php foreach ($phones as $phone): ?>
                                    <li>{{ $phone }}</li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                </tbody>
                @endif
            </table>
        </div>

    </div>
</div>
@stop
