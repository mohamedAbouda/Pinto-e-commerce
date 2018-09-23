@extends('layouts.dashboard')

@section('title','Edit a sub-category')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.subCategories.index')}}">Categories</a>
    </li>
    <li class="active">
      <strong>Edit</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">Edit sub-category, {{$resource->name}}</h2>
      <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
      <div class="row">
        {{ Form::open(['id' => 'update-sub-category' , 'route' => ['dashboard.subCategories.update' , $resource->id] , 'method' => 'PATCH']) }}
          <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            <div class="form-group">
              <label class="form-label" for="name">Sub-category Name</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="name" class="form-control" id="name" value="{{$resource->name}}" required>
              </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="category_id">Categories</label>
                <span class="desc"></span>
                <div class="controls">
                    {{ Form::select('category_id' , $categories , $resource->category_id , ['class' => 'form-control' , 'placeholder' => 'Choose category' , 'autocomplete' => 'off']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="Icon">
                    Icon : "<i class="fa {{ $resource->icon }}"></i>"
                </label>
                <div class="clearfix"></div>
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="Icon">All Icons </span>
                    <span class="caret"></span>
                </a>
                <ul id="Icon" class="dropdown-menu" style="position: relative;float:none;">
                    @foreach($icons as $icon => $code)
                    <li value="{{ $icon }}">
                        <a>
                            <i class="fa {{ $icon }}"></i>
                            {{ $icon }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                <input type="hidden" name="icon" value="{{ $resource->icon }}">
            </div>

           <!--  <div class="form-group">
                <label class="form-label" for="color">Color</label>
                <span class="desc"></span>
                <div class="controls">
                    <input type="color" name="color" id="color" class="form-control" value="{{ $resource->color }}" required>
                </div>
            </div> -->
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
    <script type="text/javascript">
    $(function(){
        $("#Icon li a").click(function(e){
            e.preventDefault();
            $(".Icon").text($(this).text());
            $('input[name=icon]').val($(this).text());
        });
    });
    </script>
@stop
