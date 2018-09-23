@extends('layouts.site.app')
@section('stylesheets')

@endsection
@section('content')
<section class="grid-shop">
   <div class="container">
    <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Shop Detail.</li>
                    </ol>
                    <div class="row">                       
                        <!-- left side -->
                        <div class="col-sm-5 col-md-5">
                            <!-- product gallery -->
                            <div class="connected-carousels">
                                <div class="stage">
                                    <div class="carousel carousel-stage" data-jcarousel="true">
                                        <ul style="">
                                        	@foreach($product->images as $image)
                                            <li><img class="zoom_01" src="{{$image->image_url}}" data-zoom-image="{{$image->image_url}}" alt="qoute-icon"> </li>
                                            @endforeach
                                    
                                        </ul>
                                    </div>
                                   
                                    <a href="#" class="prev prev-stage" data-jcarouselcontrol="true"><span>‹</span></a>
                                    <a href="#" class="next next-stage" data-jcarouselcontrol="true"><span>›</span></a>
                                </div>

                                <div class="navigation">
                                    <a href="#" class="prev prev-navigation inactive" data-jcarouselcontrol="true">‹</a>
                                    <a href="#" class="next next-navigation" data-jcarouselcontrol="true">›</a>
                                    <div class="carousel carousel-navigation" data-jcarousel="true">
                                        <ul style="left: 0px; top: 0px;">
                                        	@foreach($product->images as $image)
                                            <li data-jcarouselcontrol="true" class=""><img src="{{$image->image_url}}" width="110" height="110" alt=""></li>
                                            @endforeach
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- / product gallery -->
                        </div>
                        <!-- left side -->
                        <!-- right side -->
                        <div class="col-sm-7 col-md-7">
                            <!-- .pro-text -->
                            <div class="pro-text product-detail">
                                <!-- /.pro-img -->
                                <span class="span1">{{ $product->subCategory->category->name }}, {{ $product->subCategory->name }}</span>
                                <a href="#">
                                    <h4> {{ $product->name }} </h4>
                                </a>
                                <div class='starrr'></div>
                                <div class="star2">
                                    <ul>
                                        <li><a href="#" style="border:none;margin:auto">{{$reviews_count}} review(s)</a></li>
                                       
                                    </ul>
                                </div>
								@if($discount)
                                <p><strong>{{$product->price - (($product->price* $discount->percentage)/100)}} EGP</strong><span class="line-through">{{$product->price }} EGP</span></p>
                                @else
                                <p><strong>{{$product->price}} EGP</strong></p>
                                @endif

                                <p class="in-stock">Availability:   <span>
                                	@if($availability == 'yes')
                                In Stock
                                @else
                                Not In Stock
                                @endif
                            </span></p>
                                <br>
                               {{$product->short_description}}
                                <form>
                                    <div class="row">

                                      <div class="col-md-4">
                                        <input style="width: 100%" type="number" onclick="checkQty({{$product->id}})" onchange="checkQty({{$product->id}})" min="1" class="qty bfh-number" id="qty"  value="1">
                                      </div>
                                        @if(count($sizes) >= 1)
                                        <div class="col-md-4">
                                        <select class="form-control" name="size" id="size">
                                          <option selected disabled>Select Size</option>
                                          @foreach($sizes as $size)
                                            <option value="{{$size}}">{{$size}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                         @endif
                                        @if(count($colors) >= 1)
                                        <div class="col-md-4">
                                        <select class="form-control" name="color" id="color">
                                          <option selected disabled>Select Color</option>
                                          @foreach($colors as $color)
                                            <option value="{{$color}}">{{$color}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                         @endif
                                    </div>

                                </form>
                                <a onclick="addCart({{$product->id}})" class="addtocart2">Add to cart</a>
                                <a  onclick="wishlist({{$product->id}})" class="hart"><span class="icon icon-Heart"></span></a>
                                 <a  onclick="addCompare({{$product->id}})" class="hart"><span class="icon icon-Restart"></span></a>
                                 
                                <div class="share">
                                    <p>Share:</p>
                                    <ul>
                                        <li><a href="http://www.facebook.com/sharer.php?u=http://zcube.in/platin/platin/products-detail.html" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li> <a href="https://twitter.com/share?url=http://zcube.in/platin/platin/products-detail.html" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                                        <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://zcube.in/platin/platin/products-detail.html" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <div class="tag">
                                    
                                    <p>Tag: <span>
                                    	@if($product->keyWord)
                                    	{{$product->keyWord->text}}
                                    	@else
                                    	None
                                    	@endif
                                    </span></p>
                                </div>
                            </div>
                            <!-- /.pro-text -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="tab-bg">
                            <ul>
                                <li class="active"><a data-toggle="tab" href="#home">Description</a></li>
                                <li><a data-toggle="tab" href="#menu1">ADDITIONAL INFORMATION</a></li>
                                <li><a data-toggle="tab" href="#menu2">REVIEWS ({{$reviews_count}}) review(s)</a></li>
                                       </a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                {!! $product->description !!}
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                {!! $product->technical_specs !!}
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                    <div class="shipping-outer ">
                        	<form action="{{route('web.products.review', ['product' => $product->id])}}" method="post" >
                        		  {{csrf_field()}}
                                       <div class="col-md-5">
                                           <h4 style="margin-bottom:5px;display:inline-block">Add a review: </h4>
                                           	<div class="your-rating queue">
						<span>Your Rating</span>
						<input type="hidden" name="rate" value="1">
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" style="color: #919191;" aria-hidden="true"></i>
						<i class="fa fa-star" style="color: #919191;" aria-hidden="true"></i>
						<i class="fa fa-star" style="color: #919191;" aria-hidden="true"></i>
						<i class="fa fa-star" style="color: #919191;" aria-hidden="true"></i>
					</div>
                                        <div class="row">
                                            <div class="col-md-12 counttry">
                                              <input name="name" required placeholder="Name" type="text">
                                             
                                              <textarea rows="6" required name="review" placeholder=" Review" style="width:100%;"></textarea>
                                           </div>
                                    
                                        </div>
                                        <div class="col-md-12 ">
                                           
                                            <input type="submit" name="ok" class="add-review-btn text-center" style="width: 200px;" value="Add Review">
                                        </div>
                                       </div>
                                       </form>
                                       <div class="col-md-6 col-md-offset-1">
                                           <div class="row">
                                           	@foreach($reviews as $review)

                                               <div class="col-md-12">
                                                   <h4 style="margin-top:10px;margin-bottom:5px;">{{$review->client->name}}: </h4>
                                                   <div class="starrr{{$review->id}}">
                                                   	@if($review->rate == 1)
                                                   	<li class="one-star" style="list-style: none;">
                                                   		<span>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   		
                                                   		</span>
                                                   		

                                                   	</li>
                                                   	@elseif($review->rate == 2)
                                                   	   	<li class="two-star" style="list-style: none;">
                                                   		<span>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   		
                                                   		</span>
                                                   		

                                                   	</li>
                                                   	@elseif($review->rate == 3)
                                                   	   	<li class="three-star" style="list-style: none;">
                                                   		<span>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   		
                                                   		</span>
                                                   		

                                                   	</li>
                                                   	@elseif($review->rate == 4)
                                                   	   	<li class="four-star" style="list-style: none;">
                                                   		<span>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   			
                                                   		</span>
                                                   		

                                                   	</li>
                                                   	@elseif($review->rate == 5)
                                                   	   	<li class="five-star" style="list-style: none;">
                                                   		<span>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   			<i class="fa fa-star" aria-hidden="true"></i>
                                                   		</span>
                                                   		

                                                   	</li>
                                                   	@else
                                                   	@endif
                                                   </div><br>
                                                   {{$review->review}}
                                                    <hr>
                                                </div>
                                             
                                                @endforeach
                                            
                                            </div>
                                       </div>
                                     </div>
                                  </div>
                                 </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-demo-outer">
                        <!-- #owl-demo -->
                        <div id="owl-demo8" class="deals-wk2">
                        	@foreach($related_products->chunk(4) as $items)
                            <div class="item">
                            	@foreach($items as $item)
                                <div class="col-xs-12 col-sm-3 col-md-3">
                                    <!-- .pro-text -->
                                    <div class="pro-text text-center">
                                        <!-- .pro-img -->
                                        <div class="pro-img"> 
                                        	@foreach($item->images as $image)
                                        	<img src="{{ $image->image_url}}" style="" alt="2"> 
                                        	@break
                                        	@endforeach
                                            <!-- .hover-icon -->
                                            <div class="hover-icon"> <a ><span class="icon icon-Heart" onclick="wishlist({{$product->id}})" ></span></a> <a href="{{route('web.show.product',['product'=>$product->id])}}"><span class="icon icon-Search"></span></a> 
                                              <a ><span class="icon icon-Restart" onclick="addCompare({{$product->id}})" ></span></a> </div>
                                            <!-- /.hover-icon -->
                                        </div>
                                        <!-- /.pro-img -->
                                        <div class="pro-text-outer"> <span>{{$item->subCategory->category->name}}, {{$item->subCategory->name}}</span>
                                            <a href="{{route('web.show.product',['product'=>$item->id])}}">
                                                <h4> {{$item->name}} </h4>
                                            </a>
                                            <p class="wk-price">{{$item->price}} EGP </p> </div>
                                    </div>
                                    <!-- /.pro-text -->
                                </div>
                                @endforeach
                   

                            </div>
                            @endforeach
                                                   
                            <!-- /#owl-demo -->
                        </div>
                    </div>
                </div>
            </div>
          </section>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/site/js/incrementing.js')}}"></script>
        <!--  starrr.js Review  -->         
        <script type="text/javascript" src="{{ asset('assets/site/js/starrr.js')}}"></script>
        <!--  jcarousel Theme JavaScript  -->
        <<script type="text/javascript" src="{{ asset('assets/site/js/jquery.jcarousel.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('assets/site/js/jcarousel.connected-carousels.js')}}"></script>
        <script type="text/javascript" src="{{ asset('assets/site/js/jquery.elevatezoom.js')}}"></script>
        <script>
            $('.zoom_01').elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750
            });
        </script>
        <script type="text/javascript">
            $('.starrr').starrr({
                readOnly: true,
                rating: {{$reviews_avg}}
            });

             $('.rate').starrr({
                rating: 1
            });

             $('.your-rating').find('i.fa.fa-star').click(function(){
		var star = $(this);

		for (var i = 0; i < 5; i++) {
			if (i <= (star.index() - 2)) {
				$('.your-rating').find('i:eq(' + i + ')').css('color','#f28b00');
			}else{
				$('.your-rating').find('i:eq(' + i + ')').css('color','#919191');
			}
			console.log(i,star.index(),star.index()-2);
		}
		$('.your-rating').find('input[name=rate]').val(star.index()-1);
	});

    function addCart(id) {
    var id = id;
    var qty = $('#qty').val();
    var color = $('#color').val();
    var size = $('#size').val();
    if(qty < 1)
    {
       swal("OOOPs!", "Please add at least 1 quantity", "error");
    }else{
     $.ajax({
    
    
    type: "POST",

    url: "{{route('web.cart.addToCart')}}",
    data: {
       _token: "{{ csrf_token() }}",
      id: id,
      qty:qty,
      color:color,
      size:size,
    },
    success: function(data) {
     if(data['message'] == 'Not Available Amount.')
     {
       swal("OOOPs!", "Not Available Amount", "error");
      }else{
      location.reload();
    } 
    }
});
   }
}

function checkQty(id) {
    var id = id;
    var qty = $('.qty').val();

     $.ajax({
    type: "POST",

    url: "{{route('web.check.product.quantity')}}",
    data: {
       _token: "{{ csrf_token() }}",
      id: id,
      qty:qty,
    },
    success: function(data) {
      if(data == 'stockSumNotAvailable'){
      swal("message", "This quantity is not available right now", "error");
      }
    }
});
}
        </script>
@endsection