
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
            ({{ $user->name }})'s data.
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
                                {{ trans('web.dashboard_mrechant_pages_show_property') }}
                            </span>
                        </th>
                        <th>
                             {{ trans('web.dashboard_mrechant_pages_show_value') }}
                        </th>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_mrechant_pages_show_id') }}
                            </span>
                        </td>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                 {{ trans('web.dashboard_mrechant_pages_show_name') }}
                            </span>
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                 {{ trans('web.dashboard_mrechant_pages_show_email') }}
                            </span>
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                 {{ trans('web.dashboard_mrechant_pages_show_phone') }}
                            </span>
                        </td>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                 {{ trans('web.dashboard_mrechant_pages_show_address') }}
                            </span>
                        </td>
                        <td>
                            @if($user->address)
                            Address : {{ $user->address->address }}<br>
                            Country : {{ $user->address->country }}<br>
                            City    : {{ $user->address->city }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                 {{ trans('web.dashboard_mrechant_pages_show_profile_pic') }}
                            </span>
                        </td>
                        <td>
                            <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail" src="{{$user->profile_pic_url}}" >
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                 {{ trans('web.dashboard_mrechant_pages_show_cover_pic') }}
                            </span>
                        </td>
                        <td>
                            <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail" src="{{$user->cover_pic_url}}" >
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                 {{ trans('web.dashboard_mrechant_pages_show_bio') }}
                            </span>
                        </td>
                        <td>
                            {!! $user->bio !!}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                 {{ trans('web.dashboard_mrechant_pages_show_status') }}
                            </span>
                        </td>
                        <td>
                            <span class="text-info">
                                {{ $user->approved == 1 ? 'Approved' : 'Disapproved' }}
                            </span>
                            <form action="{{route('dashboard.merchant.status.toggle')}}" style="display: inline-block" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="merchant_id" value="{{$user->id}}">
                                <button class="btn btn-{{ $user->approved == 1 ? 'danger' : 'primary' }} btn-sm">
                                     {{ trans('web.dashboard_mrechant_pages_show_change') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                 {{ trans('web.dashboard_mrechant_pages_show_admin_accounts') }}
                            </span>
                        </td>
                        <td>
                            <ul>
                                @foreach($user->merchantAdmins as $merchant_admin)
                                <li>
                                    {{ $merchant_admin->name . ' - ' . $merchant_admin->email }}
                                </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
