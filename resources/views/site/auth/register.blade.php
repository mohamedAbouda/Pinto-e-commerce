@extends('layouts.site.app')
@section('stylesheets')
@endsection
@section('content')
 <div class="container">
            {{ Form::open(['route' => 'web.postRegister' , "id" => "form-login"]) }}

                <div class="row">
                    <div class="col-md-offset-2 col-md-8 ">
                                 <div class="shipping-outer ">
                                    <h3 class="text-center">CREATE A NEW ACCOUNT</h3>
                                    <p class="text-center">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.</p>
                                    <div class="row" style="margin-top:30px;">
                                        <div class="col-md-6 counttry">
                                          <div class="lable">Name</div>
                                          <input name="name" placeholder="" type="text">
                                          <span class="text-danger">{{ $errors->first('name') ? '('.$errors->first('name').')' : '' }}</span>
                                       </div>
                                       <div class="col-md-6 counttry">
                                          <div class="lable">Email</div>
                                          <input name="email" placeholder="" type="text">
                                          <span class="text-danger">{{ $errors->first('email') ? '('.$errors->first('email').')' : '' }}</span>
                                       </div>
                                       <div class="col-md-6 counttry">
                                          <div class="lable">Password</div>
                                          <input name="password" placeholder="" type="password">
                                          <span class="text-danger">{{ $errors->first('password') ? '('.$errors->first('password').')' : '' }}</span>
                                       </div>
                                       <div class="col-md-6 counttry">
                                          <div class="lable">Password Confirm</div>
                                          <input name="password_confirmation" placeholder="" type="password">
                                          <span class="text-danger">{{ $errors->first('password_confirmation') ? '('.$errors->first('password_confirmation').')' : '' }}</span>
                                       </div>
                                       <div class="col-md-12 counttry">
                                          <div class="lable">Phone Number</div>
                                          <input name="phone" placeholder="" type="text">
                                          <span class="text-danger">{{ $errors->first('phone') ? '('.$errors->first('phone').')' : '' }}</span>
                                       </div>
                                       <div class="col-md-12 counttry">
                                          <div class="lable">Address</div>
                                          <input name="address" placeholder="" type="text">
                                          <span class="text-danger">{{ $errors->first('address') ? '('.$errors->first('address').')' : '' }}</span>
                                       </div>
                                       <div class="col-md-12 counttry">
                                          <div class="lable">City</div>
                                          <input name="city" placeholder="" type="text">
                                          <span class="text-danger">{{ $errors->first('city') ? '('.$errors->first('city').')' : '' }}</span>
                                       </div>
                                      
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <input type="submit" name="" class="red-btn btn text-center" value="Register">
                                    </div>
                                 </div>
                              </div>
                </div>
                {{ Form::close() }}
             </div>
@endsection
@section('scripts')
@endsection