@extends('layouts.site.app')
@section('stylesheets')
<!--  starrr review -->         

@endsection
@section('content')
<div class="container">
	<div class="row">
		 <section class="shopping-cart">
            <!-- .shopping-cart -->
            <div class="container">
                <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Library</li>
                    </ol>
                </div>
                <div class="col-md-12">
                  <h2>Your Wishlist Items</h2>
                  <table>
                     <tr>
                        <th></th>
                        <th>Product name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th></th>
                     </tr>
                     @foreach($products as $product)
                     <tr id="wish{{$product->id}}">
                        <td>
                        	@if($product->product->images)
                        	@foreach($product->product->images as $image)
                        	<img src="{{$image->image_url}}" alt="13" style="width: 150px;max-width: 150px;height: 150px;max-height: 150px;">
                        	@break
                        	@endforeach
                        	@endif
                        </td>
                        <td><a href="{{route('web.show.product',['product'=>$product->product->id])}}">{{$product->product->name}}</a></td>
                        <td>{{$product->product->short_description}}</td>
                        <td><strong>{{$product->product->price}} EGP</strong></td>
                        <td onclick="deleteWishlist({{$product->id}})"><span class="red"><i class="fa fa-times" aria-hidden="true"></i></span></td>
                     </tr>
                     @endforeach
                  
                  </table>
                  <div class="col-sm-6 col-md-6">
                     <a href="{{route('index')}}" class="button red">CONTINUE SHOPPING</a>
                  </div>
                  <div class="col-sm-6 col-md-6 text-right">
                     <a href="#" onclick="updatePage()" class="button">UPDATE WISHLIST</a>
                     <a href="{{route('web.wishlist.delete.all')}}" class="button">CLEAR WISHLIST</a>
                  </div>
                  
               </div>
                </div>
               
            </div>
            <!-- /.shopping-cart -->
         </section>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	function updatePage() {
		location.reload();
	}

	function deleteWishlist(id) {
    var id = id;

       $.ajax({
    type: "POST",

    url: "{{route('web.wishlist.delete')}}",
    data: {
         _token: "{{ csrf_token() }}",
        id: id
    },
    success: function(data) {
       $('#wish'+id).remove();
    }
});
}


</script>
@endsection