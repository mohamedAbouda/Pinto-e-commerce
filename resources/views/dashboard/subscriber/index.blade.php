@extends('layouts.dashboard')

@section('title','Subscribers')

@section('stylesheets')
<style>
    .table-responsive {
        width: 100%;
        overflow-y: hidden;
        overflow-x: auto;
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
        <a href="{{ route('dashboard.subscribers.index') }}">Subscribers</a>
    </li>
    <li class="active">
        <strong>All</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">
    <header class="panel_header">
        <h2 class="title pull-left">All Subscribers</h2>
        <div class="actions panel_actions pull-right">
            <a href="{{ route('dashboard.subscribers.import') }}" class="btn btn-primary">Import subscribers</a>
        </div>
    </header>

    <div class="content-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive">
                    <table class="table table-hover" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <!-- <th>Edit</th> -->
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $offset = request()->get('page' , 1)*20 - 20;?>
                            @foreach($resources as $resource)
                            <tr>
                                <td>
                                    {{ $offset + $loop->iteration }}
                                </td>

                                <td>
                                    {{ $resource->name }}
                                </td>
                                <td>
                                    {{ $resource->email }}
                                </td>
                                <!-- <td>
                                    <a href="{{ route('dashboard.subscribers.edit' , [ $resource->id ]) }}"
                                        class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td> -->
                                <td>
                                    {{ Form::open(['route' => ['dashboard.subscribers.destroy',$resource->id ],'method'=>'delete']) }}
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
