@extends('layouts.dashboard')

@section('title','Collections')

@section('scripts')
    {{ Html::script('assets/dashboard/js/pages/products_collection.js') }}
@stop

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{ route('dashboard.collection.index') }}">Collections</a>
    </li>
    <li class="active">
        <strong>Add products to collection</strong>
    </li>
</ol>
@stop

@section('content')

{{ csrf_field() }}

<section class="box ">
    <header class="panel_header">
        <h2 class="title pull-left">Products</h2>
    </header>

    <div class="content-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <table class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Add to collection</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $offset = request()->get('page' , 1)*10 - 10;?>
                        @foreach($products as $resource)
                        <tr>
                            <td>
                                {{ $offset + $loop->iteration }}
                            </td>

                            <td>
                                {{ $resource->name }}
                            </td>
                            <td>
                                @if($resource->image)
                                    <a href="{{ url('storage/app/'.$resource->image) }}" target="_blank">
                                        View image
                                    </a>
                                @else
                                    <span>
                                        No image
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ $resource->price }}
                            </td>

                            <td>
                                <a href="#" class="btn btn-danger" onclick="toggleCollection(this);"
                                data-text-1="Add to collection" data-text-2="Remove from collection"
                                data-target="{{ route('dashboard.collection.productCollection' , [$collection->id,$resource->id]) }}">
                                    Remove from collection
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $products->links() }}
        </div>
    </div>
</section>
@stop
