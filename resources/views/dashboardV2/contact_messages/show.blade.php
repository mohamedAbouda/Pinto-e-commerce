
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
            ({{ $contact->name }}){{ trans('web.dashboard_contact_messages_pages_show_page_section_header_users_data') }}

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
                                {{ trans('web.dashboard_contact_messages_pages_show_page_property') }}
                            </span>
                        </th>
                        <th>
                            {{ trans('web.dashboard_contact_messages_pages_show_page_value') }}
                        </th>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_messages_pages_show_page_id') }}
                            </span>
                        </td>
                        <td>
                            {{ $contact->id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_messages_pages_show_page_name') }}
                            </span>
                        </td>
                        <td>
                            {{ $contact->name }}
                        </td>
                    </tr>
                      <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_messages_pages_show_page_email') }}
                            </span>
                        </td>
                        <td>
                            {{ $contact->email }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_messages_pages_show_page_subject') }}
                            </span>
                        </td>
                        <td>
                            {{ $contact->subject }}
                        </td>
                    </tr>

                       <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_contact_messages_pages_show_page_message') }}
                            </span>
                        </td>
                        <td>
                            {{ $contact->comment }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
