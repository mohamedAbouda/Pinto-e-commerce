@extends('layouts.dashboard.app')
@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Create new article</h3>
    </div>
</div>
@stop

@section('content')
{{ Form::open(['route' => 'dashboard.blog.store','files'=>'true']) }}
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Article info.</h3>
    </div>
    <div class="col-md-12">
        <div class="form-group margin-bottom20 col-md-4">
            <div class="admin-preview">
                <label class="control-label" for="cover_admin">
                    <span class="text-danger">*</span>
                    Cover image
                </label>
                <label for="cover_image" style="width:100%;">
                    <img src="{{ asset('assets/panel-assets/images/profile-picutre/01_img.png') }}" class="thumbnail image-item" alt="Upload picture" style="width:100%;cursor: pointer; cursor: hand;border: 3px solid #0081ff;">
                    <input type="file" id='cover_image' name='cover_image' style="display:none;" onchange="preview(this)";>
                </label>
            </div>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="title">
                <span class="text-danger">*</span>
                Title
            </label>
            {{ Form::text('title' ,old('title') ,['id'=>'title','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('title') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-6">
            <label class="control-label" for="categories">
                Categories/tags
            </label>
            {{ Form::select('categories[]' ,$categories ,old('categories') ,['id'=>'categories','class' => 'form-control' ,'multiple' => 'multiple']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('categories.*') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="short_description">
                <span class="text-danger">*</span>
                Short description
            </label>
            {{ Form::textarea('short_description' ,old('short_description') ,['id'=>'short_description','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('short_description') }}</p>
        </div>
        <div class="form-group margin-bottom20 col-md-12">
            <label class="control-label" for="body">
                <span class="text-danger">*</span>
                Body
            </label>
            {{ Form::textarea('body' ,old('body') ,['id'=>'body','required'=>'required','class' => 'form-control']) }}
            <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('body') }}</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-1 col-xs-4">
        <button type="submit" class="btn primary-btn">
            {{ trans('web.dashboard_create_page_save_button') }}
        </button>
    </div>
    <div class="col-md-1 col-xs-4">
        <button type="reset" class="btn cancel-btn">
            {{ trans('web.dashboard_create_page_reset_button') }}
        </button>
    </div>
</div>
{{ Form::close() }}
@stop

@section('stylesheets')
{{ Html::style('assets/panel-assets/plugins/select2/dist/css/select2.min.css') }}
@stop

@section('scripts')
{{ Html::script('assets/panel-assets/plugins/select2/dist/js/select2.full.min.js') }}
<script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
<script type="text/javascript">
function preview(input)
{
    var parent = $(input).parent();
    var preview = parent.find('img');
    var files    = input.files;

    function readAndDisplay(i ,file)
    {
        var reader  = new FileReader();
        reader.addEventListener("load", function () {
            if (i == 0) {
                return preview.attr('src',reader.result);
            }
            // var template = $('#thumbnail').html();
            // template = template.replace('###' ,reader.result);
            // $('#previews').append(template);
        }, false);
        reader.readAsDataURL(file);
    }

    if (files) {
        // $('#previews').html('');
        for (i = 0; i < files.length; i++) {
            readAndDisplay(i ,files[i]);
        }
    }
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    CKEDITOR.replace('body');
    $('#categories').select2({
        tags: true
    });
});
</script>
@stop
