@extends('layouts.dashboard')

@section('title','Delivery Options')

@section('path')
    <ol class="breadcrumb">
        <li>
            <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
        </li>
        <li>
            <a href="{{route('dashboard.delivery_options.index')}}">Delivery Options</a>
        </li>
        <li class="active">
            <strong>All</strong>
        </li>
    </ol>
@stop

@section('content')
    <section class="box ">

        <header class="panel_header">
            <h2 class="title pull-left">All Delivery Options</h2>
            <div class="actions panel_actions pull-right">
                <a href="{{route('dashboard.delivery_options.create')}}" class="btn btn-primary">Create Delivery Option</a>
            </div>
        </header>

        <div class="content-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">


                    <!-- ********************************************** -->

                    <table class="table table-hover" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Delivery Name</th>
                            <th>Price</th>
                            <!-- <th>Icon</th> -->
                            <th>Availability</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($deliveryOptions as $deliveryOption)
                            <tr>
                                <td>{{$deliveryOption->name}}</td>
                                <td>{{ $deliveryOption->price }}</td>
                                <!-- <td>
                                    @if($deliveryOption->icon)
                                        <div style="max-width: 100px; height: 100px;">
                                            <img style="max-height: 100px;" src="{{ url('storage/app/'.$deliveryOption->icon) }}">
                                        </div>
                                    @else
                                        No icon
                                    @endif
                                </td> -->
                                <td>{{$deliveryOption->availability==0?'Inactive':'Active'}}</td>

                                <td>
                                    <a href="{{url('dashboard/delivery_options/'.$deliveryOption->id.'/edit')}}"
                                       class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                       title="Edit"><i class="fa fa-edit"></i></a>

                                    <a href="{{url('dashboard/delivery_options/'.$deliveryOption->id.'/destroy')}}"
                                       class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                       title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- ********************************************** -->


                </div>
                {{$deliveryOptions->links()}}
            </div>
        </div>
    </section>
@stop
