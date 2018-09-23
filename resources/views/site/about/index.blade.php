@extends('layouts.site.app')
@section('stylesheets')
<!--  starrr review -->         

@endsection
@section('content')
<div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8 " style="padding-top:90px;">
                    <div class="shipping-outer ">
                        <h3 class="text-center">ABOUT</h3>
                        <p class="text-center">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.</p>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-bottom: 90px;">
                {!! $about->description !!}
            </div>
        </div>
@endsection
@section('scripts')
<script type="text/javascript">

</script>
@endsection