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
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_sizes_index_sizes') }} </h3>
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
        <a class="btn btn-blue margin-left-10" href="{{route('dashboard.sizes.create')}}">
            <span>+ </span>{{ trans('web.dashboard_sizes_index_add') }}
        </a>
      {{--   <div class="btn-group">
            <button type="button" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-ellipsis-h"></i>
            </button>
            <ul class="dropdown-menu contact-dropdown pull-right" role="menu">
                <li>
                    <a href="#">{{ trans('web.dashboard_sizes_index_import') }}</a>
                </li>
            </ul>
        </div> --}}
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
                        <h5 class="customer-stat-text pad5">{{ trans('web.dashboard_sizes_index_total') }}</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">{{count($sizes)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row margin-top15">
    <div class="col-md-12">
      <div class="row margin-bottom10">
            {{ $sizes->links() }}
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15">
            <table class="table table-borderless table-responsive">
                <tbody>
                    <tr>
                       
                        <th>
                            {{ trans('web.dashboard_sizes_index_name') }}
                        </th>
                       
    
                        <th>
                            {{ trans('web.dashboard_sizes_index_action') }}
                        </th>
                    </tr>
                    @foreach($sizes as $size)
                    <tr>
                        <td>
                           {{$size->name}}
                        </td>
                  
                   
                        <td>
                           <a href="{{url('dashboard/sizes/'.$size->id.'/edit')}}"
                     class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                     title="Edit"><i class="fa fa-edit"></i></a>

                  <a href="{{url('dashboard/sizes/'.$size->id.'/destroy')}}"
                     class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                     title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop