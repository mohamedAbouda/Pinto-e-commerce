@extends('layouts.dashboard')

@section('title','Edit a customer')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.customers.index')}}">Customers</a>
    </li>
    <li class="active">
      <strong>Edit</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">Edit customer, {{$customer->name}}</h2>
      <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
      <div class="row">
        <form id="update-customer" action="{{route('dashboard.customers.update',['id'=>$customer->id])}}" method="post"
              enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">

            <div class="form-group">
              <label class="form-label" for="name">Customer Name</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="name" class="form-control" id="name" value="{{$customer['name']}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="email">Email</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="email" name="email" class="form-control" id="email" value="{{$customer['email']}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="password">New Password?</label>
              <span class="desc">Hint: Password won't change if you left it blank.</span>
              <div class="controls">
                <input type="text" name="password" class="form-control" id="password">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="image">Image</label>
              <span class="desc"></span>
              @if($customer->image)
                <div style="max-width: 100px; height: 100px;">
                  <img style="max-height: 100px;" src="{{ url('storage/app/'.$customer->image) }}">
                </div>
              @endif
              <div class="controls">
                <input type="file" name="image" class="form-control" id="image">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="company">Company</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="company" class="form-control" id="company" value="{{$customer['company']}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="country_id">Country</label>
              <span class="desc"></span>
              <div class="controls">
                <select name="country_id" class="form-control" id="country_id" required>
                  @foreach($countries as $country)
                    <option value="{{$country['id']}}" {{$customer->country_id==$country['id']?' selected':''}}>{{$country['name']}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="address">Address</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="address" class="form-control" id="address" value="{{$customer['address']}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="phone">Phone</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="phone" class="form-control" id="phone" value="{{$customer['phone']}}" required>
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
