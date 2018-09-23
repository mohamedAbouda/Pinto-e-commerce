@extends('layouts.dashboard')

@section('title','Slider of the site')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.slides.index')}}">Slider</a>
    </li>
    <li class="active">
      <strong>All slides</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">All Slides</h2>
      <div class="actions panel_actions pull-right">
        <a href="{{route('dashboard.slides.create')}}" class="btn btn-primary">Create Slide</a>
      </div>
    </header>

    <div class="content-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">


          <!-- ********************************************** -->

          <table class="table table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th>ID</th>
              <th>Slide Title</th>
              <th>Slide link</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($slides as $slide)
              <tr>
                <td>{{$slide->id}}</td>
                <td>{{$slide->title}}</td>
                <td>
                    @if(isset($slide->url) && $slide->url)
                    <a href="{{ $slide->url }}">Click here</a>
                    @else
                    ...
                    @endif
                </td>
                <td style="max-width: 100px; height: 100px;">
                  @if($slide->image)
                  <img style="max-width: 100px; max-height: 100px;" src="{{ url('storage/app/'.$slide->image) }}">
                    @endif
                </td>
                <td>

                  <a href="{{url('dashboard/slides/'.$slide->id.'/edit')}}"
                     class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                     title="Edit"><i class="fa fa-edit"></i></a>

                  <a href="{{url('dashboard/slides/'.$slide->id.'/destroy')}}"
                     class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                     title="Delete"><i class="fa fa-trash-o"></i></a>

                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        {{$slides->links()}}
      </div>
    </div>
  </section>
@stop
