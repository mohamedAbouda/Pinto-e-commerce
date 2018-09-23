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
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_users_index_users') }} </h3>
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
        <a class="btn btn-blue margin-left-10" href="{{route('dashboard.users.create')}}">
            <span>+ </span>{{ trans('web.dashboard_users_index_add_new_users') }}
        </a>
        <div class="btn-group">
            <button type="button" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-ellipsis-h"></i>
            </button>
            <ul class="dropdown-menu contact-dropdown pull-right" role="menu">
             
                 <li>
                    <a href="{{route('dashboard.admin.approved.users.filter', ['status' => 'approved'])}}">{{ trans('web.dashboard_users_index_approved_users') }}</a>
                </li>
                 <li>
                    <a href="{{route('dashboard.admin.approved.users.filter', ['status' => 'disapproved'])}}">{{ trans('web.dashboard_users_index_disapproved_users') }}</a>
                </li>
            </ul>
        </div>
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
                        <h5 class="customer-stat-text pad5">{{ trans('web.dashboard_users_index_total_users') }}</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">{{count($users)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row margin-top15">
    <div class="col-md-12">
         <div class="row margin-bottom10">
            {{ $users->links() }}
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15">
            <table class="table table-borderless table-responsive">
                <tbody>
                    <tr>
                       
                        <th>
                            {{ trans('web.dashboard_users_index_name') }}
                        </th>
                      
                        <th>
                            {{ trans('web.dashboard_users_index_action') }}
                        </th>
                    </tr>
                    @foreach($users as $user)
                    <tr>
                        <td>
                           {{$user->name}}
                        </td>
                 
                        <td>
                           <a href="{{url('dashboard/users/'.$user->id.'/edit')}}"
                     class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                     title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="{{url('dashboard/users/'.$user->id)}}"
                     class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                     title="Show"><i class="fa fa-eye"></i></a>
                     @if($user->valid == 1)
                       <form action="{{route('dashboard.user.status.toggle')}}" style="display: inline-block" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <button class="btn btn-danger btn-sm">Deactivate</button>
                        </form>
                     @else
                      <form action="{{route('dashboard.user.status.toggle')}}" style="display: inline-block" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <button class="btn btn-primary btn-sm">Activate</button>
                        </form>
                     @endif

                  <form action="{{ route('dashboard.users.destroy', ['user' => $user->id]) }}" style="display: inline-block" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </button>
                            </form>
                        </td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
     
    </div>
</div>
@stop