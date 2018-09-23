@extends('layouts.dashboard')

@section('title','Edit a gift')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.gifts.index')}}">Gift Cards</a>
    </li>
    <li class="active">
      <strong>Edit</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">Edit gift, {{$gift->name}}</h2>
      <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
      <div class="row">
        <form id="update-gift" action="{{route('dashboard.gifts.update',['id'=>$gift->id])}}" method="post" enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">

            <div class="form-group">
              <label class="form-label" for="code">Code</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="code" class="form-control" id="code" value="{{$gift['code']}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="balance">Balance</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="number" step="0.01" name="balance" class="form-control" id="balance" value="{{$gift['balance']}}" required>
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