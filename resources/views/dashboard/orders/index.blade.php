@extends('layouts.dashboard')

@section('title','Orders')

@section('stylesheets')
<style>
    .table-responsive {
        width: 100%;
        overflow-y: hidden;
        overflow-x: scroll;
        -ms-overflow-style:
        -ms-autohiding-scrollbar;
        -webkit-overflow-scrolling: touch;
    }
</style>
@stop

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{ route('dashboard.orders.index') }}">Orders</a>
    </li>
    <li class="active">
        <strong>All</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">
    <header class="panel_header">
        <h2 class="title pull-left">All Orders</h2>
        <!-- <div class="actions panel_actions pull-right">
            <a href="{{ route('dashboard.orders.create') }}" class="btn btn-primary">Create Order</a>
        </div> -->
    </header>

    <div class="content-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive">
                    <table class="table table-hover" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>

                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Price paid</th>
                                <th>State</th>
                                <th>More info and change state</th>
                                <!-- <th>Edit</th> -->
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $offset = request()->get('page' , 1)*20 - 20;?>
                            @foreach($resources as $resource)
                            <tr>
                                <th>
                                    {{ $offset + $loop->iteration }}
                                </th>

                                <td>
                                    <a href="{{ route('dashboard.orders.show' , $resource->id) }}">
                                        {{ $resource->id }}
                                    </a>
                                </td>
                                <td>
                                    {{ $resource->name }}
                                </td>
                                <td>
                                    {{ $resource->email }}
                                </td>
                                <td>
                                    {{ $resource->phone }}
                                </td>
                                <td>
                                    {{ $resource->address }}
                                </td>
                                <td>
                                    {{ $resource->price }}
                                </td>
                                <td>
                                    @if($resource->state === 0)
                                    Not specified yet
                                    @elseif($resource->state === 1)
                                    <span class="text-primary">Order confirmed and user notified</span>
                                    @elseif($resource->state === 2)
                                    <span class="text-danger">Order canceled and user notified</span>
                                    @else
                                    <span class="text-info">Order refunded and user notified</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.orders.show' , [ $resource->id ]) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Show">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <!-- <td>
                                    <a href="{{ route('dashboard.orders.edit' , [ $resource->id ]) }}"
                                        class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td> -->
                                <td>
                                    {{ Form::open(['route' => ['dashboard.orders.destroy',$resource->id ],'method'=>'delete']) }}
                                    <button
                                        class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                        title="Delete">
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
            {{ $resources->links() }}
        </div>
    </div>
</section>
@stop
