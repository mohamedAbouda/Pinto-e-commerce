@extends('layouts.dashboard')

@section('title','Create a product')

@section('stylesheets')
  <!-- Select2 -->
  <link rel="stylesheet" type="text/css" href="{{url('assets/dashboard/plugins/select2/select2.css')}}">
@stop

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.products.index')}}">Products</a>
    </li>
    <li class="active">
      <strong>Create</strong>
    </li>
  </ol>
@stop

@section('content')


<div class="alert alert-info alert-dismissible fade in">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong>Info:</strong> Make sure to add <a href="{{ route('dashboard.brands.index') }}">Brands</a>,<a href="{{ route('dashboard.categories.index') }}">Categories</a>,<a href="{{ route('dashboard.colors.index') }}">Colors</a>,<a href="{{ route('dashboard.sizes.index') }}">Sizes</a> first as needed.
</div>

  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">Create new product</h2>
      <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
      <div class="row">
        <form id="create-product" action="{{route('dashboard.products.store')}}" method="post"
              enctype="multipart/form-data">

          {{csrf_field()}}

          <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">

            <div class="form-group">
              <label class="form-label" for="name">
                  <span class="text-danger"><strong>*</strong></span>
                  Product Name
              </label>
              <span class="desc"></span>
              <div class="controls">
                <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="description"><span class="text-danger"><strong>*</strong></span>Description</label>
              <span class="desc"></span>
              <div class="controls">
                <textarea form="create-product" name="description" class="form-control autogrow" rows="5" cols="5"
                          id="description">{{old('description')}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="image"><span class="text-danger"><strong>*</strong></span>Thumbnail</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="file" name="image" class="form-control" id="image" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="image">Images</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="file" name="images[]" class="form-control" multiple>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="brand_id">Brands</label>
              <span class="desc"></span>
              <div class="controls">
                <select name="brand_id" class="form-control" id="brand_id" autocomplete="off">
                    <option value="">Select a brand</option>
                  @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="category_id"><span class="text-danger"><strong>*</strong></span>Category</label>
              <span class="desc"></span>
              <div class="controls">
                <select name="category_id" class="form-control" id="category_id" autocomplete="off" required>
                  @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="sub_category_id">Sub-categories</label>
                <span class="desc"></span>
                <div class="controls sub-category-id-container">
                    {{ Form::select('sub_category_id' , $subcategories , NULL , ['class' => 'form-control' , 'placeholder' => 'Choose sub-category' , 'autocomplete' => 'off']) }}
                </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="size_id">Sizes</label>
              <span class="desc"></span>
              <div class="controls">
                <select id="size_id" name="size_id[]" class="form-control select2" multiple="multiple"
                        data-placeholder="Select sizes">
                  @foreach($sizes as $size)
                    <option value="{{$size->id}}">{{$size->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="color_id">Colors</label>
              <span class="desc"></span>
              <div class="controls">
                <select id="color_id" name="color_id[]" class="form-control select2" multiple="multiple"
                        data-placeholder="Select colors">
                  @foreach($colors as $color)
                    <option value="{{$color->id}}">{{$color->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="price"><span class="text-danger"><strong>*</strong></span>Price</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="number" min="0" name="price" class="form-control" id="price" value="{{old('price')}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="inventory"><span class="text-danger"><strong>*</strong></span>Inventory</label>
              <span class="desc"></span>
              <div class="controls">
                <input type="number" min="0" name="inventory" class="form-control" id="inventory" value="{{old('inventory')}}" required>
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

@section('scripts')
  <!-- Select2 -->
  <script src="{{url('assets/dashboard/plugins/select2/select2.min.js')}}"></script>

  <script>
    $(function () {
      function change(elm) {
          var category_id = $(elm).val();
          if (!category_id) {
              return;
          }
          $('#loading').show();
          $.ajax({
              url: '{{ route("dashboard.products.subcategories") }}',
              type: 'GET',
              data: {
                  category_id: category_id
              },
              dataType: 'json',
              success: function(response){
                  if (typeof response.html != 'undefined') {
                      $('.sub-category-id-container').html(response.html);
                  }
              }
          }).done(function(data){
              $('#loading').hide();
          });
      }
      //Initialize Select2 Elements
      $(".select2").select2();
      $('#category_id').change(function(){
          change($(this));
      });
      change($('#category_id option:selected'));
    });
  </script>
@stop
