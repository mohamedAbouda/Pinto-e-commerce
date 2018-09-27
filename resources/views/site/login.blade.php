@extends('layouts.site.app')

@section('content')
<div class="main-content space-padding-tb-70">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="customer-page">
                    <div class="text-center">
                        <h3>Login</h3>
                    </div>
                    <form method="post" class="form-customer form-login">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">Email address *</label>
                            <input type="email" class="form-control form-account" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" class="form-control form-account" name="password" id="password" required>
                        </div>
                        <div class="form-check">
                            <button type="submit" class="btn-login hover-white">Login</button>
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="remember">
                                <span>Remember me</span>
                            </label>
                            <!-- <a href="" class="lost-password">Lost your password?</a> -->
                        </div>
                    </form>
                    <span class="divider"></span>
                    <a href="{{ route('web.register') }}" class="btn link-button create-account hover-black">Create an account</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end main content-->
@stop
