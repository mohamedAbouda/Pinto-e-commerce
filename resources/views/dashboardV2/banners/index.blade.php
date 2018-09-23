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
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_banners_index_banners') }} </h3>
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
        <a class="btn btn-blue margin-left-10" href="{{route('dashboard.banners.create')}}">
            <span>+ </span>{{ trans('web.dashboard_banners_index_add_new') }}
        </a>
    </div>
</div>
@stop

@section('content')
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10">
            {{ $resources->links() }}
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15 table-responsive">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th class="text-center">
                            #
                        </th>

                        <th>
                            {{ trans('web.dashboard_banners_index_image') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_banners_index_table_header_tag') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_banners_index_table_header_title') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_banners_index_table_header_body') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_banners_index_table_header_url') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_banners_index_table_header_price') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_banners_index_table_header_position') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_banners_index_table_header_status') }}
                        </th>

                        <th style="width:15%;">
                            {{ trans('web.dashboard_banners_index_action') }}
                        </th>
                    </tr>
                    @foreach($resources as $resource)
                    <tr>
                        <td class="text-center">
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $counter_offset + $loop->iteration }}
                            </h3>
                        </td>

                        <td>
                            <img src="{{ $resource->image_url }}" style="width: 200px;height: 150px;max-width: 200px;max-height: 150px;">
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->tag }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->title }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->body }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                <a href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer">
                                    {{ $resource->url }}
                                </a>
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->price }}
                            </h3>
                        </td>
                        <td style="min-width:250px;">
                            <ul>
                                @foreach(explode(',' ,$resource->position) as $position)
                                <li>
                                    {{ $position }}
                                </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->active ? 'Active' : 'Disabled' }}
                            </h3>
                        </td>


                        <td style="width:15%;">
                            <a href="{{ url('dashboard/banners/'.$resource->id.'/edit') }}" class="btn btn-sm btn-success pull-left" data-toggle="tooltip" data-placement="top" title="Edit" style="margin-right:5px;"><i class="fa fa-edit"></i></a>
                            {{ Form::open(['route' => ['dashboard.banners.destroy',$resource->id ],'method'=>'delete' ,'class' => 'pull-left']) }}
                            <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
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
