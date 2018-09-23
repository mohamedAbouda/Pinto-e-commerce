@extends('layouts.dashboard')

@section('title','Gifts')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.gifts.index')}}">Gift Cards</a>
    </li>
    <li class="active">
      <strong>All</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">All Gifts</h2>
      <div class="actions panel_actions pull-right">
        <a href="{{route('dashboard.gifts.create')}}" class="btn btn-primary">Create Gift</a>
      </div>
    </header>

    <div class="content-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">


          <!-- ********************************************** -->

          <table class="table table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th>Code</th>
              <th>Balance</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($gifts as $gift)
              <tr>
                <td>{{$gift->code}}</td>
                <td>{{$gift->balance}}</td>
                <td>

                  <a href="{{url('dashboard/gifts/'.$gift->id.'/edit')}}"
                     class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                     title="Edit"><i class="fa fa-edit"></i></a>

                  <a href="{{url('dashboard/gifts/'.$gift->id.'/destroy')}}"
                     class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                     title="Delete"><i class="fa fa-trash-o"></i></a>

                </td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <!-- ********************************************** -->


        </div>
        {{$gifts->links()}}
      </div>
    </div>
  </section>
@stop
