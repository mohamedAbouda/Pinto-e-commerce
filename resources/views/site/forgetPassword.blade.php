@extends('layouts.site.app')

@section('content')
<div class="main-content space-padding-tb-70">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="customer-page">
                    <div class="text-center">
                        <h3>Forget Password</h3>
                    </div>
                    <form method="post" action="{{route('web.forget.password.post')}}" class="form-customer form-login">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">Email address *</label>
                            <input type="email" class="form-control form-account" name="email" id="email" required>
                        </div>
                   
                        <div class="form-check">
                            <button type="submit" class="btn-login hover-white">Login</button>
                         
                           
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
