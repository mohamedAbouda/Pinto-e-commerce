@extends('layouts.dashboard')

@section('title','Edit an inventory')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.inventory.index')}}">Inventory</a>
    </li>
    <li class="active">
      <strong>Edit</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">Update inventory of: {{$product->name}}</h2>
      <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
      <div class="row">
        <form id="update-product" action="{{route('dashboard.inventory.update',['id'=>$product->id])}}" method="post"
              enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">

            <div class="form-group">
              <label class="form-label" for="name">Product Name</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="name" class="form-control" id="name" value="{{$product->name}}" disabled>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="inventory">Inventory</label>
              <span class="desc">Hint: Product won't appear at the site when it is out of stock.</span>
              <div class="controls">
                <input type="number" min="0" name="inventory" class="form-control" id="inventory" value="{{$product->inventory}}" required>
              </div>
            </div>


          </div>

          <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
            <div class="text-left">
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="reset" class="btn">Reset</button>
            </div>

            <div class="text-right">
              <a href="{{url('dashboard/products/'.$product->id.'/edit')}}"
                 data-toggle="tooltip" data-placement="top"
                 title="Update Inventory"> Want to update the other data of this product?
              </a>
            </div>
          </div>



        </form>
      </div>

    </div>
  </section>
@stop