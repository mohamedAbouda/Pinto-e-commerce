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
        @if(! $policy)
        <a href="{{ route('dashboard.policy.create') }}" class="resizeBtn btn btn-primary">
            {{ trans('web.dashboard_policy_pages_index_page_add_policy') }}
        </a>
        @else
        <a href="{{ route('dashboard.policy.edit', ['policy' => $policy->id])  }}" class="resizeBtn btn btn-primary">
            {{ trans('web.dashboard_policy_pages_index_page_edit_policy') }}
        </a>
        @endif
    </div>

    <table class="table table-bordered">
        <tbody>
            @if($policy)
            <tr>
                <td>Description</td>
                <td colspan="2">{!! $policy->description !!}</td>
            </tr>
            @endif
            @foreach($policy_faq as $faq)
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
