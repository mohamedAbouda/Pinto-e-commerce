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
            @if(! $about)
    			<a href="{{ route('dashboard.about.create') }}" class="resizeBtn btn btn-primary">{{ trans('web.dashboard_about_pages_index_page_create_button') }}</a>
            @else
            <a href="{{ route('dashboard.about.edit', ['about' => $about->id])  }}" class="resizeBtn btn btn-primary">{{ trans('web.dashboard_about_pages_index_page_edit_button') }}</a>
            @endif
    		</div>
    	<div class="panel panel-default">

    		      <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    </thead>
                    <tbody>
                        @if($about)

                        <tr>

                            <td>{!! $about->description !!}</td>
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
