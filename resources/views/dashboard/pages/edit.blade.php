@extends('layouts.dashboard')

@section('title','Update page')

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{route('dashboard.pages.index')}}">Pages</a>
    </li>
    <li class="active">
        <strong>Create</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">

    <header class="panel_header">
        <h2 class="title pull-left">Update Page</h2>
        <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
        <div class="row">
            <form id="create-category" action="{{ route('dashboard.pages.update', ['page' => $page->id]) }}" method="post" enctype="multipart/form-data">
  <input type="hidden" name="_method" value="PUT">
                 {{ csrf_field() }}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="form-group">
                        <label class="form-label" for="name">Page Title</label>
                        <span class="desc"></span>
                        <div class="controls">
                            <input type="text" name="title" class="form-control" id="title" value="{{$page->title}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Page URL</label>
                        <span class="desc"></span>
                        <div class="controls">
                            <select class="form-control" name="menu">
                                <option value="">Select a link</option>
                                @foreach($web_menus as $menu)
                                    <option value="{{ $menu->id }}"> {{ $menu->name }} </option>
                                    @if(isset($menu->children))
                                        @foreach($menu->children as $child)
                                            <option value="{{ $child->id }}"> {{ $child->name }} </option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>





                    <div class="form-group">
                        <label class="form-label" for="description">Content</label>
                        <span class="desc"></span>
                        <div class="controls">
                            <textarea form="create-category" name="content" class="form-control autogrow" rows="5" cols="5" id="content">{{$page->content}}</textarea>
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
