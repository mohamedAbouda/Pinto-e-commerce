@extends('layouts.site.app')

@section('content')
<div class="main-content space-padding-tb-70">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="customer-page">
                    <div class="text-center">
                        <h3>Reset your password</h3>
                    </div>
                    <form method="post" action="{{route('web.client.change.password')}}" class="form-customer form-login">
                        <input type="hidden" name="token" value="{{ $token }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" value="{{ $reset->email }}" class="form-control form-account" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" class="form-control form-account" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password *</label>
                            <input type="password" class="form-control form-account" name="password_confirmation" id="password-confirm" required>
                        </div>
                        <div class="form-check">
                            <button type="submit" class="btn-login hover-white">Reset</button>
                        </div>
                    </form>
                    <span class="divider"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end main content-->
@stop
