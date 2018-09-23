@extends('layouts.site.app')
@section('stylesheets')
<!--  starrr review -->

@endsection
@section('content')
<div class="container">
	<div class="row">
		<section>
			<div class="container">
				<div class="row" style="margin-top:90px;">
					<div class="col-md-10 col-md-offset-1">
						<div class="col-md-4" style="padding-top:20px;margin-top:35px;">
							<ul>
								<li>
									<i class="icon-location-pin icons" aria-hidden="true"></i>
									<strong>Address:</strong> {{ $contact ? $contact->address : '' }}
								</li>
							</ul>
						</div>
						<div class="col-md-4" style="padding-top:20px;margin-top:35px;">
							<ul>
								<li>
									<i class="icon-envelope-letter icons"></i>
									<strong>Email:</strong> {{ $contact ? $contact->email : '' }}
								</li>
							</ul>
						</div>
						<div class="col-md-4" style="padding-top:20px;margin-top:35px;">
							<ul>
								<li>
									<i class="icon-call-in icons"></i>
									<strong>Phone Number:</strong> {{ $contact ? $contact->phones : '' }}
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<form action="{{ route('web.submit.contact') }}" method="post" id="form-contact" accept-charset="utf-8">
							{{ csrf_field() }}
							<div class="shipping-outer ">
								<h3 class="text-center">CONTACT US</h3>
								<p class="text-center">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.</p>
								<div class="row" style="margin-top:30px;">
									<div class="col-md-4 counttry">
										<div class="lable">Name</div>
										<input name="name" required placeholder="" type="text">
									</div>
									<div class="col-md-4 counttry">
										<div class="lable">Email</div>
										<input name="email" required placeholder="" type="text">
									</div>
									<div class="col-md-4 counttry">
										<div class="lable">Subject</div>
										<input name="subject" required placeholder="" type="text">
									</div>
									<div class="col-md-12 counttry">
										<textarea placeholder="" required name="comment" style="width:100%;" rows="8"></textarea>
									</div>
								</div>
								<div class="col-md-12 text-center">
									<button class="red-btn text-center" type="submit" style="width: 100px;">Send</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

		</section>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
function submitForm() {
}
</script>
@endsection
