@extends('layouts.site.app')
@section('stylesheets')
@endsection
@section('content')
	<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">

					<div class="shipping-outer ">
						<h3 class="text-center">Order Dispute</h3>
						<p class="text-center">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.</p>
						<div class="row" style="margin-top:30px;">
							 <form action="{{route('web.order.dispute.store')}}" method="post" id="form-contact" accept-charset="utf-8">
                                    <div class="form-box  name-contact">
                                        {{csrf_field()}}
							<div class="col-md-6 counttry">
								<div class="lable">Name</div>
								<input name="name" required placeholder="" type="text">
							</div>
							<div class="col-md-6 counttry">
								<div class="lable">Issue</div>
								 <select class="form-control" name="status" required>
                                            <option value="8" class="order-dispute" selected disabled>Select Dispute</option>
                                        <option value="8" class="order-dispute">Dispute Not Delivered</option>
                                        <option value="9" class="order-dispute">Dispute Wrong Order</option>
                                        <option value="10" class="order-dispute">Dispute Bad Product</option>
                                        <option value="11" class="order-dispute">Dispute Other</option>
                                      
                                        </select>
							</div>
							                                        <input type="hidden" name="order_id" value="{{$id}}"> 

							
							<div class="col-md-12 counttry">
								<textarea name="dispute_comment" placeholder="Comment" style="width:100%;" rows="8"></textarea>
							</div>
						</div>
						<div class="col-md-12 text-center">
							<button type="submit" class="btn btn-primary">Send</button>
						</div>
					</form>
					</div>
				</div>
			</div>

		</div>
@endsection
@section('scripts')
@endsection