
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
     <div class="col-md-4 col-md-offset-1 text-right col-xs-11">
       
        <a href="{{ route('dashboard.merchant.get.profile.edit') }}"class="btn btn-warning margin-left-10">
            Edit 
        </a>
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
                                {{trans('web.dashboard_mrechant_pages_show_property')}}
                            </span>
                        </th>
                        <th>
                            {{trans('web.dashboard_mrechant_pages_show_value')}}
                        </th>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_mrechant_pages_show_id')}}
                            </span>
                        </td>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_mrechant_pages_show_name')}}
                            </span>
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_mrechant_pages_show_email')}}
                            </span>
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                      <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_mrechant_pages_show_phone')}}
                            </span>
                        </td>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                       <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_mrechant_pages_edit_mobile_number')}}
                            </span>
                        </td>
                        <td>
                            {{ $user->mobile }}
                        </td>
                    </tr>
                       <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_mrechant_pages_edit_hot_line')}}
                            </span>
                        </td>
                        <td>
                            {{ $user->hot_line }}
                        </td>
                    </tr>
                       <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_mrechant_pages_edit_created_by')}}
                            </span>
                        </td>
                        <td>
                            {{ $user->created_by }}
                        </td>
                    </tr>
                         <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                 {{trans('web.dashboard_mrechant_pages_show_address')}}
                            </span>
                        </td>
                        @if($user->address)
                        <td>
                            Address : {{$user->address->address}}<br>
                            Country : {{$user->address->country}}<br>
                            City    : {{$user->address->city}}<br>
                            Governorate    : {{$user->address->governorate->name}}
                        </td>
                        @else
                        <td>
                        No Address.
                    </td>
                        @endif
                    </tr>
                      <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                  {{trans('web.dashboard_mrechant_pages_show_profile_pic')}}
                            </span>
                        </td>
                        <td>
                        <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail" src="{{$user->profile_pic_url}}" >
                        </td>
                    </tr>
                      <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{trans('web.dashboard_mrechant_pages_show_cover_pic')}}
                            </span>
                        </td>
                        <td>
                           <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail" src="{{$user->cover_pic_url}}" >
                        </td>
                    </tr>
                       <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                  {{trans('web.dashboard_mrechant_pages_show_bio')}}
                            </span>
                        </td>
                        <td>
                            {!! $user->bio !!}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

