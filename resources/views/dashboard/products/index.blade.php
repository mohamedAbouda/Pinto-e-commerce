@extends('layouts.dashboard')

@section('title','Products')

@section('scripts')
{{ Html::script('assets/dashboard/js/pages/products_collection.js') }}
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
        <strong>All</strong>
    </li>
</ol>
@stop

@section('content')

{{ csrf_field() }}
<section class="box nobox">
    <div class="content-body">
        <div class="row">

            <div class="col-md-3 col-sm-12 col-xs-12">
                <nav class='pull-right'>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#web-1" aria-controls="grid" role="tab" data-toggle="tab">
                                Grid
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#web-2" aria-controls="table" role="tab" data-toggle="tab">
                                Table
                            </a>
                        </li>
                    </ul>
                    {{$products->links()}}
                </nav>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="tab-content vertical col-md-12">
                    <div class="tab-pane fade in active" id="web-1">
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-lg-3 col-sm-6 col-md-4 ecommerce_product">
                                <div class="team-member ">
                                    <div class="team-img thumb ">
                                        <img class="img-responsive" src="{{ url('storage/app/'.$product->image) }}">
                                        <div class="overlay">
                                            <a href="{{url('dashboard/products/'.$product->id.'/edit')}}"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </div>
                                    <div class="team-info ">
                                        <h4><a href="#">{{$product->name}}</a></h4>
                                        <span>${{$product->price}}</span>

                                        <span class="pull-right">
                                            <a href="{{url('dashboard/products/'.$product->id.'/edit')}}"
                                                class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                                title="Edit"><i class="fa fa-edit"></i>
                                            </a>

                                            <a href="{{url('dashboard/products/'.$product->id.'/destroy')}}"
                                                class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                                title="Delete"><i class="fa fa-trash-o"></i>
                                            </a>
                                            <a href="#" data-id="{{ $product->id }}" data-target="{{ route('dashboard.collection.product' , $product->id) }}"
                                                class="btn btn-sm btn-warning set-to-collection" data-toggle="tooltip" data-placement="top"
                                                title="Set to a collection"><i class="fa fa-sitemap"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="web-2">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Image
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            Inventory
                                        </th>
                                        <th>
                                            Category
                                        </th>
                                        <th>
                                            Wishlist count
                                        </th>
                                        <th>
                                            Edit
                                        </th>
                                        <th>
                                            Delete
                                        </th>
                                        <th>
                                            Set to collection
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $offset = request()->get('page' , 1)*20 - 20; ?>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>
                                            {{ $offset + $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                        <td>
                                            <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail"
                                            src="{{ url('storage/app/'.$product->image) }}" alt="No image uploaded">
                                        </td>
                                        <td>
                                            {{ $product->price }}
                                        </td>
                                        <td>
                                            {{ $product->inventory }}
                                        </td>
                                        <td>
                                            {{ $product->category->name }}
                                        </td>
                                        <td>
                                            {{ $product->wish_count }}
                                        </td>
                                        <td>
                                            <a href="{{url('dashboard/products/'.$product->id.'/edit')}}"
                                                class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                                title="Edit"><i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{url('dashboard/products/'.$product->id.'/destroy')}}"
                                                class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                                title="Delete"><i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" data-id="{{ $product->id }}" data-target="{{ route('dashboard.collection.product' , $product->id) }}"
                                                class="btn btn-sm btn-warning set-to-collection" data-toggle="tooltip" data-placement="top"
                                                title="Set to a collection"><i class="fa fa-sitemap"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="productsForCollection" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    Collections
                </h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop
