@extends('layouts.dashboard')

@section('title','About')

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{route('dashboard.categories.index')}}">About</a>
    </li>
    <li class="active">
        <strong>Edit</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">

    <header class="panel_header">
        <h2 class="title pull-left">Edit About</h2>
        <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
        <div class="row">
            <form id="update-about" action="{{route('dashboard.about.update')}}" method="post"
            enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label class="form-label" for="content">Content</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <textarea form="update-about" name="content" class="form-control autogrow" rows="5" style="width:100%"
                        id="content">{{ $data && isset($data->content)?$data->content:'' }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="logo">Logo image</label>
                    <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail" id="logo-preview"
                    src="{{ $data && $data->image ? url('storage/app/'.$data->image) : '' }}" alt="No image uploaded">
                    <div class="controls">
                        <label for="image" class="btn btn-primary">
                            Upload about us image
                            <input type="file" name="image" id="image" class="form-control hidden" onchange="preview(this);">
                        </label>
                        <span id="logo-text" class="text-primary">
                        </span>
                    </div>
                    <p class="text-danger">{{ $errors->first('image') }}</p>
                </div>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>

        </form>
    </div>

</div>
</section>
@stop

@section('scripts')
<script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.replace('content');
function preview(fileInput)
{
    document.getElementById('logo-text').innerHTML = document.getElementById('image').value;

    var preview = document.getElementById('logo-preview');
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
