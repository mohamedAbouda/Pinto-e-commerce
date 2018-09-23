@extends('layouts.dashboard')

@section('title','Edit a brand')

@section('scripts')
<script type="text/javascript">
    function preview(fileInput)
    {
        document.getElementById('image-text').innerHTML = document.getElementById('image').value;

        var preview = document.getElementById('image-preview');
        var file    = fileInput.files[0];
        var reader  = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@stop

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{route('dashboard.brands.index')}}">Brand</a>
    </li>
    <li class="active">
        <strong>Edit</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">

    <header class="panel_header">
        <h2 class="title pull-left">
            Edit a brand
        </h2>
        <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
        <div class="row">
            {{ Form::open(['route'=>['dashboard.brands.update' , $resource->id] , 'method' => 'PATCH' , 'files' => TRUE]) }}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-label" for="name">
                        Name
                    </label>
                    <div class="controls">
                        {{ Form::text('name' , $resource->name , ['id' => 'name' , 'class' => 'form-control']) }}
                    </div>
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="image">Image</label>
                    <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail" id="image-preview"
                    src="{{ $resource->image_url }}" alt="No image Chosen">
                    <div class="controls">
                        <label for="image" class="btn btn-primary">
                            Upload image
                            <input type="file" name="image" id="image" class="form-control hidden" onchange="preview(this);">
                        </label>
                        <span id="image-text" class="text-primary">
                        </span>
                    </div>
                    <p class="text-danger">{{ $errors->first('image') }}</p>
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
