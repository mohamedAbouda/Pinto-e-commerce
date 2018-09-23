@extends('layouts.dashboard')

@section('title','Collections')

@section('scripts')
    {{ Html::script('assets/dashboard/js/pages/collection.js') }}
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
        <strong>All</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">
    <header class="panel_header">
        <h2 class="title pull-left">All Collections</h2>
        <div class="actions panel_actions pull-right">
            <a href="{{ route('dashboard.collection.create') }}" class="btn btn-primary">Create Collection</a>
        </div>
    </header>
<strong>**Note :</strong>The url will start with 'collections' word before the collection name.
    <div class="content-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <table class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Banner text</th>
                            <th>Banner location</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Manage products</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $offset = request()->get('page' , 1)*10 - 10;?>
                        @foreach($resources as $resource)
                        <tr>
                            <td>
                                {{ $offset + $loop->iteration }}
                            </td>
                               <td>
                                {{ $resource->title }}
                            </td>
                            <td>
                                {{ str_replace(' ','-',$resource->title) }}
                            </td>
                            <td>
                                {{ $resource->description }}
                            </td>
                            <td>
                                @if($resource->image)
                                    <a href="{{ $resource->image_url }}" target="_blank">
                                        View image
                                    </a>
                                @else
                                    <span>
                                        No image
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($resource->banner_text)
                                    <a href="{{ $resource->banner_text_url }}" target="_blank">
                                        View banner
                                    </a>
                                @else
                                    <span>
                                        No image
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ $resource->banner_location }}
                            </td>

                            <td>
                                <a href="{{ route('dashboard.collection.edit' , [ $resource->id ]) }}"
                                    class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                    title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                {{ Form::open(['route' => ['dashboard.collection.destroy',$resource->id ],'method'=>'delete']) }}
                                <button
                                    class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                    title="Delete">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                <a href="{{ route('dashboard.collection.show' , [ $resource->id ]) }}" data-id="{{ $resource->id }}"
                                    class="btn btn-sm btn-warning setProductsBtn"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Set products">
                                    <i class="fa fa-sitemap"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $resources->links() }}
        </div>
    </div>
</section>
@stop
