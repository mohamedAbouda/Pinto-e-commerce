@extends('layouts.dashboard.app')
@section('title','Policy')
@section('description','')
@section('stylesheets')
<style type="text/css">
.pagination > li > a {
    background: #fafafa;
    color: #666;
}
.pagination.pagination-flat > li > a {
    border-radius: 0 !important;
}
</style>
@endsection
@section('content')
<div class="col-md-12">
    <div class="panel-heading">
        @if(! $shipping)
        <a href="{{ route('dashboard.shipping.create') }}" class="resizeBtn btn btn-primary">
           Add Shipping & return policy
        </a>
        @else
        <a href="{{ route('dashboard.shipping.edit', ['shipping' => $shipping->id])  }}" class="resizeBtn btn btn-primary">
                      Edit Shipping & return policy
        </a>
        @endif
    </div>
    <div class="panel panel-default">

        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                </thead>
                <tbody>
                    @if($shipping)
                    <tr>
                        <td>{!! $shipping->shipping_and_return !!}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>
@endsection
