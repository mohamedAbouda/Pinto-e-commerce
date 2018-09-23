@extends('layouts.site.app')

@section('content')
<div class="container">
	<div class="row">
		<section>
			<div class="container">
				<div class="col-md-12">
					<div style="width: 100%;height: 600px;">
				        {!! Mapper::render() !!}
				    </div>
				</div>
			</div>
		</section>
	</div>
</div>
@endsection
