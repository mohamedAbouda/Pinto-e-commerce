@extends('layouts.dashboard')

@section('title','SocialMedias')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.socialmedias.index')}}">SocialMedias</a>
    </li>
    <li class="active">
      <strong>All</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">All SocialMedias</h2>
      <div class="actions panel_actions pull-right">
        <a href="{{route('dashboard.socialmedias.create')}}" class="btn btn-primary">Create SocialMedia</a>
      </div>
    </header>

    <div class="content-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">


          <!-- ********************************************** -->

          <table class="table table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th>Title</th>
              <th>Icon</th>
              <th>URL</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($socialmedias as $socialmedia)
              <tr>
                <td>{{$socialmedia->title}}</td>
                <td style="max-width: 100px; height: 100px;">
                  @if($socialmedia->icon)
                  <img style="max-height: 100px;" src="{{ url('storage/app/'.$socialmedia->icon) }}">
                    @endif
                </td>
                <td>{{$socialmedia->url}}</td>
                <td>

                  <a href="{{url('dashboard/socialmedias/'.$socialmedia->id.'/edit')}}"
                     class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                     title="Edit"><i class="fa fa-edit"></i></a>

                  <a href="{{url('dashboard/socialmedias/'.$socialmedia->id.'/destroy')}}"
                     class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                     title="Delete"><i class="fa fa-trash-o"></i></a>

                </td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <!-- ********************************************** -->


        </div>
        {{$socialmedias->links()}}
      </div>
    </div>
  </section>
@stop