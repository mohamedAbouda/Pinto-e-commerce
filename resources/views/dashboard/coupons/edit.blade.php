@extends('layouts.dashboard')
@section('title','Coupons - Edit')

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{ route('dashboard.coupons.index') }}">Coupons</a>
    </li>
    <li class="active">
        <strong>Edit</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">
    <header class="panel_header">
        <h2 class="title pull-left">Edit a coupon</h2>
    </header>

    <div class="content-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                {{ Form::open(['route' => ['dashboard.coupons.update' , $resource->id] , 'method' => 'PATCH']) }}
                <div class="row">
                    <div class="">
                        <label for="code">
                            Code :
                        </label>
                    </div>
                    <div class="col-md-10" style="margin-bottom: 10px;">
                        {{ Form::text('code' , $resource->code , ['class' => 'form-control' , 'id' => 'code' , 'autocomplete' => 'off']) }}
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary" id="generate-code-btn">Generate code</button>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <label for="percentage">
                            Percentage :
                        </label>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 10px;">
                        {{ Form::number('percentage' , $resource->percentage , ['class' => 'form-control' , 'id' => 'percentage' , 'min' => '0' , 'autocomplete' => 'off']) }}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
    <script type="text/javascript">
    $(document).ready(function(){
        $('#generate-code-btn').click(function(){
            $('#loading').show();
            $.ajax({
	            url: '{{ route('dashboard.coupons.generate') }}',
	            type: 'GET',
	            dataType: 'json',
	            success: function(response){
                    $('#code').val(response.code);
                    $('#loading').hide();
	            }
	        });
        });
    });
    </script>
@stop
