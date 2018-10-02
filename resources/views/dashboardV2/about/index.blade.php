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
<div class="row">
    <div class="col-md-12">
        @if(! $about)
        <a href="{{ route('dashboard.about.create') }}" class="resizeBtn btn btn-primary">{{ trans('web.dashboard_about_pages_index_page_create_button') }}</a>
        @else
        <a href="{{ route('dashboard.about.create', ['about' => $about->id])  }}" class="resizeBtn btn btn-primary">{{ trans('web.dashboard_about_pages_index_page_edit_button') }}</a>
        @endif
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-responsive">
                <thead>
                </thead>
                <tbody>
                    @if($about)
                    <tr>
                        <td>
                            <?php if ($about->brand_image): ?>
                                <img src="{{ $about->brand_image_url }}" class="thumbnail" width="300px">
                            <?php endif; ?>
                        </td>
                        <td style="width: 300px;">{{ $about->about_header }}</td>
                        <td style="width: 600px;">{{ $about->description }}</td>
                        <td>
                            <?php if ($about->mission_image): ?>
                                <img src="{{ $about->mission_image_url }}" class="thumbnail" width="300px">
                            <?php endif; ?>
                        </td>
                        <td style="width: 300px;">{{ $about->mission_header }}</td>
                        <td style="width: 600px;">{{ $about->mission_description }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
