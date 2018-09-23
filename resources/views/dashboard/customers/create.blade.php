@extends('layouts.dashboard')

@section('title','Create a customer')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.customers.index')}}">Customers</a>
    </li>
    <li class="active">
      <strong>Create</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">Create new customer</h2>
      <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
      <div class="row">
        <form id="create-customer" action="{{route('dashboard.customers.store')}}" method="post"
              enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">

            <div class="form-group">
              <label class="form-label" for="name">Customer Name</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="email">Email</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="password">Password</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="password" class="form-control" id="password" value="{{old('password')}}"
                       required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="image">Image</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="file" name="image" class="form-control" id="image">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="company">Company</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="company" class="form-control" id="company" value="{{old('company')}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="country_id">Country</label>
              <span class="desc"></span>
              <div class="controls">
                <select name="country_id" class="form-control" id="country_id" required>
                  @foreach($countries as $country)
                    <option value="{{$country['id']}}">{{$country['name']}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="address">Address</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="address" class="form-control" id="address" value="{{old('address')}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="phone">Phone</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="phone" class="form-control" id="phone" value="{{old('phone')}}" required>
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