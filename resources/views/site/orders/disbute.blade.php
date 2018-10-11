@extends('layouts.site.app')

@section('content')
<div class="main-content space-padding-tb-70">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="text-center" style="margin-bottom:20px;">
					<h3>Order Dispute</h3>
				</div>
				<div class="row" style="margin-top:30px;">
					<form class="form-customer form-login" action="{{ route('web.order.dispute.store') }}" method="post" accept-charset="utf-8">
						<div class="form-box  name-contact">
							{{ csrf_field() }}
							<div class="form-group col-md-6">
								<div class="lable">Name</div>
								<input type="text" name="name" class="form-control form-account" required>
							</div>
							<div class="form-group col-md-6">
								<div class="lable">Issue</div>
								<select class="form-control form-account" name="status" required>
									<option value="8" class="order-dispute" selected disabled>Select Dispute</option>
									<option value="8" class="order-dispute">Dispute Not Delivered</option>
									<option value="9" class="order-dispute">Dispute Wrong Order</option>
									<option value="10" class="order-dispute">Dispute Bad Product</option>
									<option value="11" class="order-dispute">Dispute Other</option>
								</select>
							</div>
							<input type="hidden" name="order_id" value="{{ $id }}">
							<div class="form-group col-md-12">
								<div class="lable">Comment</div>
								<textarea name="dispute_comment" class="form-control form-account" style="width:100%;height: 300px;" rows="40"></textarea>
							</div>
						</div>
						<div class="col-md-12 text-center">
							<button type="submit" class="btn-login hover-white">Send</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
