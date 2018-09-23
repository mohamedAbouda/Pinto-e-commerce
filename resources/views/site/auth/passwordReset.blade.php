@extends('layouts.site.app')
@section('stylesheets')
@endsection
@section('content')
<div class="container">
  <form  method="POST" action="{{ route('web.auth.postForgetPassword') }}">
  {{ csrf_field() }}

  <div class="row">
    <div class="col-md-offset-2 col-md-8 ">
     <div class="shipping-outer ">
      <h3 class="text-center">Reset Password</h3>
      <p class="text-center">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.</p>
      <div class="row" style="margin-top:30px;">

       <div class="col-md-12 counttry">
        <div class="lable">Email</div>
        <input name="email" placeholder="" type="text">
        @if ($errors->has('email'))
        <span class="help-block">
          <strong style="color:red;margin-right: 300px;">{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>





    </div>
    <div class="col-md-6 text-center" style="margin-left: 200px;">
      <input type="submit" name="" class="red-btn btn text-center" value="Send">
    </div>
  </div>
</div>
</div>
</form>
</div>
@endsection
@section('scripts')
@endsection