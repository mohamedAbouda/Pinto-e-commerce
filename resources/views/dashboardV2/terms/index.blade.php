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
    	<div class="panel panel-default">
    	
    		      <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    </thead>
                    <tbody>
                        @if($term)
                       
                        <tr>
                           
                            <td>{!! $term->description !!}</td>
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