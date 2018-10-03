
@extends('layouts.dashboard.app')

@section('stylesheets')
<style>
body {
    background-color:#edeff9;
}
</style>
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">
            Article details
        </h3>
    </div>
    <div class="col-md-8 text-right">
        <a href="{{ route('dashboard.blog.create') }}"class="btn btn-default margin-left-10">
            <span>+ </span>Create new blog article
        </a>
        <a href="{{ route('dashboard.blog.edit',$resource->id) }}"class="btn btn-warning margin-left-10">
            Edit blog article
        </a>
    </div>
</div>
@stop

@section('content')
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10 contacts-list-view-card pad15">
            <table class="table table-borderless table-responsive" style="">
                <tbody>
                    <tr>
                        <th class="text-center">
                            Title
                        </th>
                        <td>
                            {{ $resource->title }}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">
                            Cover image
                        </th>
                        <td>
                            <?php if ($resource->cover_image): ?>
                                <img src="{{ $resource->cover_image_url }}" class="thumbnail">
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">
                            Categories/Tags
                        </th>
                        <td>
                            <ul>
                                @foreach($resource->categories as $category)
                                <li>
                                    {{ $category->name }}
                                </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr style="border-top: #d5d1d1;border-top-style: solid;border-top-width: 1px;">
                        <td colspan="2">
                            {!! $resource->body !!}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
