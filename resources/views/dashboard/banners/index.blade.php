@extends('layouts.dashboard')

@section('title','Banners')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.banners.index')}}">Banners</a>
    </li>
    <li class="active">
      <strong>All</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">All Banners</h2>
      <!-- <div class="actions panel_actions pull-right">
        <a href="{{route('dashboard.banners.create')}}" class="btn btn-primary">Create Banner</a>
      </div> -->
    </header>

    <div class="content-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">


          <!-- ********************************************** -->

          <table class="table table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th>Title</th>
              <th>Image</th>
              <th>URL</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($banners as $banner)
              <tr>

                <td>{{$banner->title}}</td>
                <td style="max-width: 200px; height: 200px;">
                  @if($banner->image)
                    <img class="thumbnail" style="max-height: 100%;max-width: 100%;" src="{{ url('storage/app/'.$banner->image) }}">
                  @endif
                </td>
                <td>{{$banner->url}}</td>
                <td>
                  <a href="{{url('dashboard/banners/'.$banner->id.'/edit')}}"
                     class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                     title="Edit"><i class="fa fa-edit"></i></a>

                  <a href="{{url('dashboard/banners/'.$banner->id.'/destroy')}}"
                     class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                     title="Delete"><i class="fa fa-trash-o"></i></a>
                </td>

              </tr>
            @endforeach
            </tbody>
          </table>

          <!-- ********************************************** -->


        </div>
        {{$banners->links()}}
      </div>
    </div>
  </section>
@stop
