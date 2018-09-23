@extends('layouts.dashboard')

@section('title','Create a color')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.colors.index')}}">Colors</a>
    </li>
    <li class="active">
      <strong>Create</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">Create new color</h2>
      <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
      <div class="row">
        <form id="create-color" action="{{route('dashboard.colors.store')}}" method="post" enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">

            <div class="form-group">
              <label class="form-label" for="name">Name</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="code">Color</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="color" name="code" class="form-control" id="code" value="{{old('code')}}" required>
              </div>
            </div>

          </div>

          <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
            <div class="text-left">
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="reset" class="btn">Reset</button>
            </div>
          </div>

        </form>
      </div>

    </div>
  </section>
@stop