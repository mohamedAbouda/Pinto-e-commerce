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
        @if(! $term)
        <a href="{{ route('dashboard.terms.create') }}" class="resizeBtn btn btn-primary">{{ trans('web.dashboard_terms_index_add_terms') }}  </a>
        @else
        <a href="{{ route('dashboard.terms.edit', ['term' => $term->id])  }}" class="resizeBtn btn btn-primary">{{ trans('web.dashboard_terms_index_edit') }}  </a>
        @endif
    </div>
    <table class="table table-bordered">
        
        <tbody>
            @if($term)
            <tr>
                <td>Description</td>
                <td colspan="2">{!! $term->description !!}</td>
            </tr>
            @endif
            @foreach($terms_faq as $faq)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $faq->question }}
                </td>
                <td>
                    {{ $faq->answer }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
