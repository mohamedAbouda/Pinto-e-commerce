@extends('layouts.dashboard')

@section('title','Pages')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.pages.index')}}">Pages</a>
    </li>
    <li class="active">
      <strong>All</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">All Pages</h2>
      <div class="actions panel_actions pull-right">
        <a href="{{route('dashboard.pages.create')}}" class="btn btn-primary">Create Page</a>
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
              <th>Page Title</th>

            </tr>
            </thead>

            <tbody>
            @foreach($pages as $page)
              <tr>
                <td>{{$page->id}}</td>
                <td>{{$page->title}}</td>

                <td>

                  <a href="{{ route('dashboard.pages.edit', ['page' => $page->id]) }}"
                     class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                     title="Edit"><i class="fa fa-edit"></i></a>

                    <form action="{{ route('dashboard.pages.destroy', ['page' => $page->id]) }}" style="display: inline-block" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="_method" value="DELETE">
                              <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                     title="Delete"><i class="fa fa-trash-o"></i></button>
                          </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <!-- ********************************************** -->


        </div>
        {{$pages->links()}}
      </div>
    </div>
  </section>
@stop
