@extends('layouts.site.app')
@section('stylesheets')
@endsection
@section('content')
<div class="container">
  <div class="row">
    {{ Form::open(['route' => 'web.login' ,'id' => "form-login"]) }}
    <div class="col-md-offset-2 col-md-8 ">
     <div class="shipping-outer ">
      <h3 class="text-center">LOGIN TO YOUR ACCOUNT</h3>
      <p class="text-center">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.</p>
      <div class="row" style="margin-top:30px;">
        <div class="col-md-8 col-md-offset-2 counttry">
          <div class="lable">Email</div>
          <input name="email" placeholder="" required type="text">
        </div>

        <div class="col-md-8 col-md-offset-2 counttry">
          <div class="lable">Password</div>
          <input name="password" required placeholder="" type="password">
        </div>
        <div class="col-md-8 col-md-offset-2 checkbox">
          <input type="checkbox"  id="remember" checked name="remember">
          <label for="remember">Remember me</label>
        </div>
      </div>

      <div class="col-md-12 text-center">
 <button type="submit" class="red-btn text-center">Login</button>
       </div>
    </div>
  </div>

  {{ Form::close() }}
</div>
</div>
@endsection
@section('scripts')
@endsection