@extends('layouts.dashboard')
@section('title','Coupons')

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{ route('dashboard.coupons.index') }}">Coupons</a>
    </li>
    <li class="active">
        <strong>All</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">
    <header class="panel_header">
        <h2 class="title pull-left">All Coupons</h2>
        <div class="actions panel_actions pull-right">
            <a href="{{ route('dashboard.coupons.create') }}" class="btn btn-primary">Create Coupon</a>
        </div>
    </header>

    <div class="content-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive">
                    <table class="table table-hover" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Percentage</th>
                                <th>Edit</th>
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
                                    {{ $resource->code }}
                                </td>
                                <td>
                                    {{ $resource->percentage }} %
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.coupons.edit' , [ $resource->id ]) }}"
                                        class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    {{ Form::open(['route' => ['dashboard.coupons.destroy',$resource->id ],'method'=>'delete']) }}
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
