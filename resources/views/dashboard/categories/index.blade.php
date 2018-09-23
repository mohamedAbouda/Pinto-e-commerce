@extends('layouts.dashboard')

@section('title','Categories')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.categories.index')}}">Categories</a>
    </li>
    <li class="active">
      <strong>All</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">All Categories</h2>
      <div class="actions panel_actions pull-right">
        <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary">Create Category</a>
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
              <th>Category Name</th>
              <th>Icon</th>
              <th>Color</th>
              <th>Banner</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($categories as $category)
              <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>
                  @if($category->icon)
                  <i class="fa {{ $category->icon }}"></i>
                  @endif
                </td>
                <td style="width:38px;">
                    @if($category->color)
                    <div class="thumbnail"style="">
                        <div style="background-color:{{ $category->color }};width:27px;height:25px;">
                        </div>
                    </div>
                    @endif
                </td>
                <td style="width:243px;">
                    @if($category->banner)
                    <div class="thumbnail"style="">
                        <img src="{{ url('storage/app/'.$category->banner) }}" style="width:241px;height:165px;" alt="">
                    </div>
                    @endif
                </td>
                <td>

                  <a href="{{url('dashboard/categories/'.$category->id.'/edit')}}"
                     class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                     title="Edit"><i class="fa fa-edit"></i></a>

                  <a href="{{url('dashboard/categories/'.$category->id.'/destroy')}}"
                     class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                     title="Delete"><i class="fa fa-trash-o"></i></a>

                </td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <!-- ********************************************** -->


        </div>
        {{$categories->links()}}
      </div>
    </div>
  </section>
@stop
