@extends('layouts.dashboard')

@section('title','Admins')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.admins.index')}}">Admins</a>
    </li>
    <li class="active">
      <strong>All</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">All Admins</h2>
      <div class="actions panel_actions pull-right">
        <a href="{{route('dashboard.admins.create')}}" class="btn btn-primary">Create Admin</a>
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
              <th>Admin Name</th>

            </tr>
            </thead>

            <tbody>
            @foreach($admins as $admin)
              <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
    
                <td>

                  <a href="{{ route('dashboard.admins.edit', ['admin' => $admin->id]) }}"
                     class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                     title="Edit"><i class="fa fa-edit"></i></a>

                    <form action="{{ route('dashboard.admins.destroy', ['admin' => $admin->id]) }}" style="display: inline-block" method="post">
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
        {{$admins->links()}}
      </div>
    </div>
  </section>
@stop
