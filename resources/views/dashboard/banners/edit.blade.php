@extends('layouts.dashboard')

@section('title','Edit a banners')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.banners.index')}}">Banners</a>
    </li>
    <li class="active">
      <strong>Edit</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">Edit banners, "{{$banner->title}}"</h2>
      <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
      <div class="row">
        <form id="update-banners" action="{{route('dashboard.banners.update',['id'=>$banner->id])}}" method="post"
              enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

            <div class="form-group">
              <label class="form-label" for="title">Title</label>
              <p class="desc">Note : You don't need to change this .. (you probably shouldn't)</p>
              <div class="controls">
                <input type="text" name="title" class="form-control" id="title" value="{{$banner['title']}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="image">Image</label>
              <p class="desc">Note : {{ $banner->note }}</p>
              @if($banner->image)
                <div style="max-width: 100px; height: 100px;">
                  <img style="max-height: 100px;" src="{{ url('storage/app/'.$banner->image) }}">
                </div>
              @endif
              <div class="controls">
                <input type="file" name="image" class="form-control" id="image">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="url">URL</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="url" name="url" class="form-control" id="url" value="{{$banner['url']}}" required>
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
