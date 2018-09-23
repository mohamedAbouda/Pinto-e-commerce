@extends('layouts.dashboard')

@if(isset($resource))
    @section('title','Edit a collection')
@else
    @section('title','Create a collection')
@endif

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{route('dashboard.collection.index')}}">Collection</a>
    </li>
    <li class="active">
        @if(isset($resource))
            <strong>Edit</strong>
        @else
            <strong>Create</strong>
        @endif
    </li>
</ol>
@stop

@section('content')
<section class="box ">

    <header class="panel_header">
        <h2 class="title pull-left">
            @if(isset($resource))
                Edit collection
            @else
                Create new collection
            @endif
        </h2>
        <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
        <div class="row">
            @if(isset($resource))
                {{ Form::open(['route'=>['dashboard.collection.update' , $resource->id] , 'method' => 'PATCH' , 'files' => TRUE]) }}
                <input type="hidden" name="resource_id" value="{{ $resource->id }}">
            @else
                {{ Form::open(['route'=>'dashboard.collection.store' , 'files' => TRUE]) }}
            @endif
            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">
                <div class="form-group">
                    <label class="form-label" for="title">Title</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="text" name="title" id="title" class="form-control" value="{{ isset($resource)?$resource->title:old('title') }}" required>
                    </div>
                    <p class="text-danger">{{ $errors->first('title') }}</p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Description</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <textarea name="description" id="description" class="form-control autogrow" rows="5" cols="5">{{ isset($resource)?$resource->description:old('description') }}</textarea>
                    </div>
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="image">Image</label>
                    <span class="desc"></span>
                    @if(isset($resource) && $resource->image)
                      <div style="max-width: 100px; height: 100px;">
                        <img style="max-height: 100px;" src="{{ $resource->image_url }}">
                      </div>
                    @endif
                    <div class="controls">
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <p class="text-danger">{{ $errors->first('image') }}</p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="banner_text">Banner text (image)</label>
                    <span class="desc"></span>
                    @if(isset($resource) && $resource->banner_text)
                      <div style="max-width: 100px; height: 100px;">
                        <img style="max-height: 100px;" src="{{ $resource->banner_text_url }}">
                      </div>
                    @endif
                    <div class="controls">
                        <input type="file" name="banner_text" id="banner_text" class="form-control">
                    </div>
                    <p class="text-danger">{{ $errors->first('banner_text') }}</p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="banner_location">Banner location</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="text" name="banner_location" id="banner_location" class="form-control" value="{{ isset($resource)?$resource->banner_location:old('banner_location') }}" required>
                    </div>
                    <p class="text-danger">{{ $errors->first('banner_location') }}</p>
                </div>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn">Reset</button>
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>
</section>
@stop
