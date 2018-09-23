@extends('layouts.dashboard')

@section('title','Update page')

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{route('dashboard.pages.index')}}">Admin</a>
    </li>
    <li class="active">
        <strong>Create</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">

    <header class="panel_header">
        <h2 class="title pull-left">Update Admin</h2>
        <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
        <div class="row">
            <form id="create-category" action="{{ route('dashboard.admins.update', ['admin' => $admin->id]) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="resource_id" value="{{ $admin->id }}">
                {{ csrf_field() }}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="form-group">
                        <label class="form-label" for="name">Admin Name</label>
                        <span class="desc"></span>
                        <div class="controls">
                            <input type="text" name="name" class="form-control" id="name" value="{{$admin->name}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name"> E-mail</label>
                        <span class="desc"></span>
                        <div class="controls">
                            <input type="email" name="email" class="form-control" id="email" value="{{$admin->email}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Password</label>
                        <span class="desc"></span>
                        <div class="controls">
                            <input type="password" name="password" class="form-control" id="password" value="{{old('password')}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Confirm Password</label>
                        <span class="desc"></span>
                        <div class="controls">
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" value="{{old('password_confirmation')}}" >
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

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2.css') }}">
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('dashboard/plugins/select2.js') }}"></script>
<script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
<script type="text/javascript">
$(function(){
    $("#Icon li a").click(function(e){
        e.preventDefault();
        $(".Icon").text($(this).text());
        $('input[name=icon]').val($(this).text());
    });
});

CKEDITOR.replace('content');

</script>
@stop
