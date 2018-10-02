@extends('layouts.dashboard.app')
@section('title','Locations')
@section('description','')
@section('stylesheets')

@endsection

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">
            {{ trans('web.dashboard_sub_store_locations_locations_store_locations') }}
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
        <a href="{{ route('dashboard.storelocations.create') }}"class="btn btn-blue margin-left-10">
            <span>+ </span>{{ trans('web.dashboard_sub_store_locations_locations_add_store_location') }}
        </a>
    </div>
</div>
@stop
@section('content')

<div style="width: 100%; height: 500px;">
    {!! Mapper::render() !!}
</div>
<table class="table table-borderless table-responsive">
    <tbody>
        <tr>

            <th>
                {{ trans('web.dashboard_sub_store_locations_locations_address') }}
            </th>

            <th>
                {{ trans('web.dashboard_sub_store_locations_locations_action') }}
            </th>
        </tr>
        @foreach($locations as $location)
        <tr>
            <td>
                {{$location->address}}
            </td>

            <td>
                <a href="{{ route('dashboard.storelocations.edit', ['location' => $location->id]) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>

                <form action="{{ route('dashboard.storelocations.destroy', ['location' => $location->id]) }}" style="display: inline-block" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('scripts')

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ENV('MAPS_API_KEY')}}&callback=initMap"></script>
@endsection
