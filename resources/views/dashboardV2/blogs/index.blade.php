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
            Blog articles
        </h3>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="row">
            <div class="col-md-4 sort-col col-xs-4">
            </div>
            <div class="col-md-3 contact-edit-col col-xs-4">
            </div>
        </div>
    </div>
    <div class="col-md-4 col-md-offset-1 text-right col-xs-11">
        <a href="{{ route('dashboard.blog.create') }}"class="btn btn-blue margin-left-10">
            <span>+ </span>Create a new article
        </a>
    </div>
</div>
@stop

@section('content')
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10">
            {{ $resources->links() }}
        </div>
        <div class="row margin-bottom10 contacts-list-view-card pad15">
            <table class="table table-borderless table-responsive" style="margin-bottom:0;">
                <tbody>
                    <tr>
                        <th class="text-center">#</th>
                        <th>
                            Title
                        </th>
                        <th>
                            Published at
                        </th>
                        <th></th>
                    </tr>
                    @foreach($resources as $resource)
                    <tr class="">
                        <td class="text-center">
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $counter_offset + $loop->iteration }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="margin-top10 contact-details-view" style="font-weight: 400;">
                                <a href="{{ route('dashboard.blog.show', $resource->id) }}">
                                    {{ $resource->title }}
                                </a>
                            </h3>
                        </td>
                        <td>
                            <h3 class="margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $resource->created_at ? $resource->created_at->toDayDateTimeString() : '' }}
                            </h3>
                        </td>
                        <td>
                            <div class="no-shadow btn-group pull-right" style="margin:0;padding:0;">
                                <button type="button" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle contact-edit-dots-shdw pad0" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-h fa-lg edit-btn-contact-ico-color"></i>
                                </button>
                                <ul class="dropdown-menu contact-dropdown pull-right">
                                    <li>
                                        <a href="{{ route('dashboard.blog.edit', $resource->id) }}">
                                            Edit
                                        </a>
                                    </li>
                                    <li>
                                        {{ Form::open(['route' => ['dashboard.blog.destroy' ,$resource->id] ,'method' => 'DELETE' ,'class' => "delete-form"]) }}
                                        <button type="submit">
                                            Delete
                                        </button>
                                        {{ Form::close() }}
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
$(document).ready(function(){
    $('.delete-form').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var url = $(this).attr('action');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this entry!",
            type: "error",
            confirmButtonText: 'Yes',
            showConfirmButton: true,
            cancelButtonText: 'Cancel',
            showCancelButton: true,
            closeOnConfirm: false,
            html: false
        } ,function(){
            $.ajax({
                url: url,
                method: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function(response){
                    form.parents('tr').remove();
                    swal({
                        title: "Success",
                        text: response.message,
                        type: "success"
                    });
                }
            });
        });
    });
});
</script>
@stop
