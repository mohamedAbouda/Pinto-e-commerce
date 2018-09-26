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
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_sliders_index_sliders') }} </h3>
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
        <a class="btn btn-blue margin-left-10" href="{{route('dashboard.sliders.create')}}">
            <span>+ </span>{{ trans('web.dashboard_sliders_index_add_new') }}
        </a>
    </div>
</div>
@stop

@section('content')
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10">
            {{ $sliders->links() }}
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15 table-responsive">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th class="text-center">
                            #
                        </th>

                        <th>
                            {{ trans('web.dashboard_sliders_index_image') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_sliders_index_table_header_tag') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_sliders_index_table_header_head1') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_sliders_index_table_header_desc') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_sliders_index_table_header_url') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_sliders_index_table_header_action_text') }}
                        </th>

                        <th style="width:15%;">
                            {{ trans('web.dashboard_sliders_index_action') }}
                        </th>
                    </tr>
                    @foreach($sliders as $slider)
                    <tr>
                        <td class="text-center">
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $counter_offset + $loop->iteration }}
                            </h3>
                        </td>

                        <td>
                            <img src="{{ $slider->image_url }}" style="width: 200px;height: 150px;max-width: 200px;max-height: 150px;">
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $slider->tag }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $slider->head1 }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $slider->desc }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $slider->url }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $slider->action_text }}
                            </h3>
                        </td>


                        <td style="width:15%;">
                            <a href="{{ url('dashboard/sliders/'.$slider->id.'/edit') }}" class="btn btn-sm btn-success pull-left" data-toggle="tooltip" data-placement="top" title="Edit" style="margin-right:5px;"><i class="fa fa-edit"></i></a>
                            {{ Form::open(['route' => ['dashboard.sliders.destroy',$slider->id ],'method'=>'delete' ,'class' => 'pull-left']) }}
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
