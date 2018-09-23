@extends('layouts.dashboard')

@section('title','Settings')

@section('stylesheets')
<link href="{{ asset('assets/dashboard/plugins/nestable/style.css') }}" rel="stylesheet" type="text/css"/>
@stop

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a>Settings</a>
    </li>
    <li class="active">
        <a href="{{ route('dashboard.setting.manageMenu') }}">Menu</a>
    </li>
</ol>
@stop

@section('content')
<section class="box ">
    <header class="panel_header">
        <h2 class="title pull-left">
            Manage header menu
        </h2>
    </header>

    <div class="content-body">
        <div class="row">
            <div class="col-md-6">
                <h3>Menu</h3>
                <div class="dd nestable" id="nestable">
                    <ol class="dd-list">
                        @foreach($menu as $item)
                        <li class="dd-item" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-slug="{{ $item->slug }}" data-new="{{ $item->new }}" data-deleted="{{ $item->deleted }}">
                            <div class="dd-handle">{{ $item->name }}</div>
                            <span class="button-delete btn btn-default btn-xs pull-right" data-owner-id="{{ $item->id }}">
                                <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                            </span>
                            <span class="button-edit btn btn-default btn-xs pull-right" data-owner-id="{{ $item->id }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </span>
                            @if(isset($item->children) && count($item->children) > 0)
                            <ol class="dd-list">
                                @foreach($item->children as $child_lvl_1)
                                <li class="dd-item" data-id="{{ $child_lvl_1->id }}" data-name="{{ $child_lvl_1->name }}" data-slug="{{ $child_lvl_1->slug }}" data-new="{{ $child_lvl_1->new }}" data-deleted="{{ $child_lvl_1->deleted }}">
                                    <div class="dd-handle">{{ $child_lvl_1->name }}</div>
                                    <span class="button-delete btn btn-default btn-xs pull-right" data-owner-id="{{ $child_lvl_1->id }}">
                                        <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                    </span>
                                    <span class="button-edit btn btn-default btn-xs pull-right" data-owner-id="{{ $child_lvl_1->id }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </span>
                                    @if(isset($child_lvl_1->children) && count($child_lvl_1->children) > 0)
                                    <ol class="dd-list">
                                        @foreach($item->children as $child_lvl_2)
                                        <li class="dd-item" data-id="{{ $child_lvl_2->id }}" data-name="{{ $child_lvl_2->name }}" data-slug="{{ $child_lvl_2->slug }}" data-new="{{ $child_lvl_2->new }}" data-deleted="{{ $child_lvl_2->deleted }}">
                                            <div class="dd-handle">{{ $child_lvl_2->name }}</div>
                                            <span class="button-delete btn btn-default btn-xs pull-right" data-owner-id="{{ $child_lvl_2->id }}">
                                                <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                            </span>
                                            <span class="button-edit btn btn-default btn-xs pull-right" data-owner-id="{{ $child_lvl_2->id }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </span>
                                        </li>
                                        @endforeach
                                    </ol>
                                    @endif
                                </li>
                                @endforeach
                            </ol>
                            @endif
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>


            <div class="col-md-6">
                <form class="" id="menu-add">
                    <h3>Add new menu item</h3>
                    <div class="form-group">
                        <label for="addInputName">Name</label>
                        <input type="text" class="form-control" id="addInputName" placeholder="Item name" required>
                    </div>
                    <div class="form-group">
                        <label for="addInputSlug">Slug</label>
                        <p class="text-danger">Don't change if not neccessary. You can create your own page <a href="{{ route('dashboard.pages.create') }}">here</a></p>
                        <input type="text" class="form-control" id="addInputSlug" placeholder="item-slug" value="#" disabled>
                        <p class="desc">or choose from existing routes</p>
                        <select class="form-control" id="addSelectSlug" autocomplete="off">
                            <option value="">Select from existing routes</option>
                            <option value="web.index">Home</option>
                            <option value="web.products.index">All products</option>
                            <option value="$categories">Categores</option>
                            <option value="web.blog.index">Blog</option>
                            <option value="web.contactUs">Contact us</option>
                            <option value="web.aboutUs">About us</option>
                        </select>
                    </div>

                    <button class="btn btn-info" id="addButton">Add</button>
                </form>

                <form class="" id="menu-editor" style="display: none;">
                    <h3>Editing <span id="currentEditName"></span></h3>
                    <div class="form-group">
                        <label for="editInputName">Name</label>
                        <input type="text" class="form-control" id="editInputName" placeholder="Item name" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="editInputSlug">Slug</label>
                        <p class="text-danger">Don't change if not neccessary</p>
                        <input type="text" class="form-control" id="editInputSlug" placeholder="item-slug">
                        <p class="desc">or choose from existing routes</p>
                        <select class="form-control" id="editSelectSlug" autocomplete="off">
                            <option value="">Select from existing routes</option>
                            <option value="web.index">Home</option>
                            <option value="web.products.index">All products</option>
                            <option value="$categories">Categores</option>
                            <option value="web.blog.index">Blog</option>
                            <option value="web.contactUs">Contact us</option>
                            <option value="web.aboutUs">About us</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-info" id="editButton">Edit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['id' => 'menu-submit-form' , 'route' => 'dashboard.setting.update']) }}
                <input type="hidden" name="web_menu" value="">
                {{ Form::close() }}
                <button id="menu-submit-btn" type="submit" class="btn btn-primary">Submit</button>
                {{ Form::open(['route' => 'dashboard.setting.menu.reset' , 'class' => 'pull-right']) }}
                <button id="menu-reset-btn" type="submit" class="btn btn-default">Reset to default</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
    <script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>

<script type="text/javascript" src="{{ asset('assets/dashboard/plugins/nestable/jquery.nestable.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/dashboard/plugins/nestable/jquery.nestable++.js') }}"></script>
<script type="text/javascript">
$('#nestable').nestable().on('change', updateOutput);
$('#menu-submit-btn').click(function(e){
    e.preventDefault();
    var web_menu = window.JSON.stringify($('.dd').nestable('serialize'));
    $('input[name=web_menu]').val(web_menu);
    if (!web_menu) {
        return;
    }
    $('#menu-submit-form').submit();
});
</script>
@stop
