@extends('layouts.dashboard.app')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2.css') }}">
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">
          Create Coupon
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

</div>
@stop

@section('content')

<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row">
            <form id="create-category" action="{{route('dashboard.coupons.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-12">
                    <h3 class="secondry-title">
                        Create Coupon
                    </h3>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">
                            Coupon Code
                        </label>
                        <input type="text" class="form-control" id="formInput25" required name="code" value="{{old('code')}}">
                         <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('code') }}</p>
                    </div>

                </div>
             
                <div class="col-md-12">

                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">
                            Discount 
                        </label>
                        <input type="number" min="0" step="any" name="percentage" value="{{old('percentage')}}" class="form-control">
                        ** if the discount less than 1 it will be precentage and if it's more than 1 it will be amount
                        <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('percentage') }}</p>
                    </div>
                </div>


                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">
                            {{ trans('web.dashboard_create_page_save_button') }}
                        </button>
                        <button type="reset" class="btn btn-danger">
                            {{ trans('web.dashboard_create_page_reset_button') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script type="text/javascript" src="{{ asset('dashboard/plugins/select2.js') }}"></script>
<script type="text/javascript">
$(function(){
    $("#Icon li a").click(function(e){
        e.preventDefault();
        $(".Icon").text($(this).text());
        $('input[name=icon]').val($(this).text());
    });
});
</script>
@stop
