
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
            ({{ $resource->name }})'s data.
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
                        <td colspan="2">
                            <h3 class="secondry-title">{{trans('web.dashboard_mrechant_admins_pages_show_personal_info')}}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                <label class="control-label">
                                    {{trans('web.dashboard_mrechant_pages_show_name')}}
                                </label>
                            </span>
                        </td>
                        <td>
                            {{ $resource->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                <label class="control-label">
                                     {{trans('web.dashboard_mrechant_pages_show_email')}}
                                </span>
                            </label>
                        </td>
                        <td>
                            {{ $resource->email }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                <label class="control-label">
                                     {{trans('web.dashboard_mrechant_pages_show_phone')}}
                                </label>
                            </span>
                        </td>
                        <td>
                            {{ $resource->phone }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h3 class="secondry-title">{{trans('web.dashboard_mrechant_admins_pages_show_merchant_info')}}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                <label class="control-label">
                                     {{trans('web.dashboard_mrechant_pages_show_name')}}
                                </label>
                            </span>
                        </td>
                        <td>
                            {{ $merchant->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                <label class="control-label">
                                     {{trans('web.dashboard_mrechant_pages_show_email')}}
                                </label>
                            </span>
                        </td>
                        <td>
                            {{ $merchant->email }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                <label class="control-label">
                                     {{trans('web.dashboard_mrechant_pages_show_phone')}}
                                </label>
                            </span>
                        </td>
                        <td>
                            {{ $merchant->phone }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                <label class="control-label">
                                    {{trans('web.dashboard_mrechant_pages_show_profile_pic')}}
                                </label>
                            </span>
                        </td>
                        <td>
                            <img src="{{ $merchant->profile_pic_url }}" alt="{{ $merchant->name }} (img didn't load)" class="thumbnail" style="width: 200px;max-width: 200px;height: 200px;max-height: 200px">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                <label class="control-label">
                                   {{trans('web.dashboard_mrechant_pages_show_cover_pic')}}
                                </label>
                            </span>
                        </td>
                        <td>
                            <img src="{{ $merchant->cover_pic_url }}" alt="{{ $merchant->name }} (img didn't load)" class="thumbnail" style="width: 200px;max-width: 200px;height: 200px;max-height: 200px">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
