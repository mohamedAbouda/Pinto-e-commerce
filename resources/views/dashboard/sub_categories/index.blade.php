@extends('layouts.dashboard')

@section('title','Sub-categories')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.subCategories.index')}}">Sub-categories</a>
    </li>
    <li class="active">
      <strong>All</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">All Sub-categories</h2>
      <div class="actions panel_actions pull-right">
        <a href="{{route('dashboard.subCategories.create')}}" class="btn btn-primary">Create Sub-category</a>
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
              <th>Sub-category Name</th>
              <th>Category</th>
              <th>Icon</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($resources as $resource)
              <tr>
                <td>{{ $loop->iteration + (request()->get('page' , 1) * 20 - 20) }}</td>
                <td>{{ $resource->name }}</td>
                <td>
                    <a href="{{ route('dashboard.categories.edit' , $resource->category_id) }}">
                        {{ $resource->category->name }}
                    </a>
                </td>
                <td>
                  @if($resource->icon)
                  <i class="fa {{ $resource->icon }}"></i>
                  @endif
                </td>
              
                <td>
                    <a href="{{ route('dashboard.subCategories.edit' , $resource->id) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    {{ Form::open(['route'=>['dashboard.subCategories.destroy' , $resource->id] , 'class' => 'pull-left' , 'method' => 'DELETE']) }}
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                        <i class="fa fa-trash-o"></i>
                    </button>
                    {{ Form::close() }}
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <!-- ********************************************** -->


        </div>
        {{$resources->links()}}
      </div>
    </div>
  </section>
@stop
