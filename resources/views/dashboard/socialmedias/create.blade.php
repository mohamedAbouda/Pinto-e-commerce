@extends('layouts.dashboard')

@section('title','Create a socialmedia')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.socialmedias.index')}}">SocialMedias</a>
    </li>
    <li class="active">
      <strong>Create</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">Create new socialmedia</h2>
      <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
      <div class="row">
        <form id="create-socialmedia" action="{{route('dashboard.socialmedias.store')}}" method="post" enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">

            <div class="form-group">
              <label class="form-label" for="title">Title</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="url">URL</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="url" name="url" class="form-control" id="url" value="{{old('url')}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="icon">Icon</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="file" name="icon" class="form-control" id="icon">
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