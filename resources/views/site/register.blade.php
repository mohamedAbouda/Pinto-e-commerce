@extends('layouts.site.app')

@section('content')
<div class="main-content space-padding-tb-70">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<div class="customer-page">
					<div class="text-center">
						<h3>Register</h3>
					</div>
					<form method="post" class="form-customer form-login">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="name">Full name *</label>
							<input type="text" class="form-control form-account" id="name" name="name" required>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email address *</label>
							<input type="email" class="form-control form-account" id="email" name="email" required>
						</div>
						<div class="form-group">
							<label for="password">Password *</label>
							<input type="password" class="form-control form-account" id="password" name="password" required>
						</div>
						<div class="form-group">
							<label for="password_confirmation">Password confirmation *</label>
							<input type="password" class="form-control form-account" id="password_confirmation" name="password_confirmation" required>
						</div>
						<div class="form-group">
							<label for="phone">Phone Number *</label>
							<input type="text" class="form-control form-account" id="phone" name="phone" required>
						</div>
						<div class="form-group">
							<label for="address">Address *</label>
							<input type="text" class="form-control form-account" id="address" name="address" required>
						</div>
						<div class="form-group">
							<label for="city">City *</label>
							<input type="text" class="form-control form-account" id="city" name="city" required>
						</div>

						<div class="form-check">
							<button type="submit" class="btn-login btn-register hover-white">Register</button>
						</div>
					</form>
					<span class="divider"></span>
					<a href="{{ route('web.login') }}" class="btn link-button create-account hover-black">Login</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end main content-->
@stop
