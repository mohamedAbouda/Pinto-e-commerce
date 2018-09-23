@extends('layouts.dashboard')

@section('title','Create a delivery option')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.delivery_options.index')}}">Delivery Options</a>
    </li>
    <li class="active">
      <strong>Create</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">Create new delivery option</h2>
      <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
      <div class="row">
        <form id="create-deliveryOption" action="{{route('dashboard.delivery_options.store')}}" method="post"
              enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">

            <div class="form-group">
              <label class="form-label" for="name">Delivery Name</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" required>
              </div>
            </div>

            <!-- <div class="form-group">
              <label class="form-label" for="icon">Icon</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="file" name="icon" class="form-control" id="icon">
              </div>
            </div> -->

            <div class="form-group">
                <label class="form-label" for="price">Price</label>
                <span class="desc"></span>
                <div class="controls">
                    <input type="number" name="price" class="form-control" min="0" id="price" value="{{ old('price',0) }}" required>
                </div>
            </div>


            <div class="form-group">
              <label class="form-label" for="availability">Availability</label>
              <span class="desc"></span>
              <div class="controls">
                <select name="availability" class="form-control" id="availability" required>
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                </select>
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
