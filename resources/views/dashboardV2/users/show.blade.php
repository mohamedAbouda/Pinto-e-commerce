
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
                                {{ trans('web.dashboard_users_show_property') }}
                            </span>
                        </th>
                        <th>
                            {{ trans('web.dashboard_users_show_value') }}
                        </th>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_users_show_id') }}
                            </span>
                        </td>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_users_show_name') }}
                            </span>
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_users_show_email') }}
                            </span>
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_users_show_phone') }}
                            </span>
                        </td>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                    @if($user->addresses || $user->address)
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_users_show_address') }}
                            </span>
                        </td>
                        <td>
                            @foreach($user->addresses as $address)
                            Address : {{ $address->address }}<br>
                            Country : {{ $address->country }}<br>
                            City    : {{ $address->city }}<br>
                            <br>
                            @endforeach

                            @if($user->address)
                            Address : {{ $user->address->address }}<br>
                            Country : {{ $user->address->country }}<br>
                            City    : {{ $user->address->city }}<br>
                            <br>
                            @endif
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_users_show_profile_picture') }}
                            </span>
                        </td>
                        <td>
                            <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail" src="{{$user->profile_pic_url}}" >
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
