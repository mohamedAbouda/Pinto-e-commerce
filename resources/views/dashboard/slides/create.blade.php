@extends('layouts.dashboard')

@section('title','Create a slide')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.slides.index')}}">Slider</a>
    </li>
    <li class="active">
      <strong>Create a slide</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">Create new slide</h2>
      <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
      <div class="row">
        <form id="create-slide" action="{{route('dashboard.slides.store')}}" method="post" enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">

            <div class="form-group">
              <label class="form-label" for="title">Slide Title</label>
              <p class="desc">Note: Make it as short as possible (3:4 words).</p>
              <div class="controls">
                <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}">
              </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="url">Link</label>
                <div class="controls">
                    <input type="text" name="url" class="form-control" id="url" value="{{ old('url') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="url_link_text">Link button text</label>
                <div class="controls">
                    <input type="text" name="url_link_text" class="form-control" id="url_link_text" value="{{ old('url_link_text') }}">
                </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="description">Description</label>
               <p class="desc">Note: Make it as short as possible.</p>
              <div class="controls">
                <textarea form="create-slide" name="description" class="form-control autogrow" rows="5" cols="5" id="description">{{old('description')}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="image">Image</label>
              <p class="desc">Hint: best image dimensions are (width 871 * height 500px).</p>
              <p class="desc">Hint: max size is 5MB the larger the image the slower the website.</p>
              <div class="controls">
                <input type="file" name="image" class="form-control" id="image">
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
