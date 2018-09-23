@extends('layouts.site.app')
@section('stylesheets')
@endsection
@section('content')
<section class="shopping-cart">
    <!-- .shopping-cart -->
    <div class="container">
      <div class="row">
      <!--   <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Library</li>
        </ol>
      </div> -->
        <div class="col-md-12">
          <h2>Your active orders</h2>
          <table>
            <tr>
              <th></th>
              <th>Product Image</th>
              <th>Product name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Delivery Status</th>
              <th>Action</th>
              <th></th>
              
            </tr>
      @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <div class="delete">
                                                    <a href="{{route('web.order.submit.dispute',$order->id)}}" title=""><img src="{{asset('assets/site/images/icons/dispute.png')}}" alt=""></a>
                                                </div>
                                                 </td>
                                              <td>
                                                <div class="product">
                                                    <div class="image">
                                                     @foreach($order->items as $item)
                                                     @if($item->product->cover_image)
                                                      <img src="{{$item->product->cover_image_url}}"  style="max-width: 150px;max-height: 150px;">
                                                     @else
                                                     @foreach($item->product->images as $image)
                                                     <img src="{{$image->image_url}}">
                                                     @break
                                                     @endforeach
                                                     @endif
                                                     @break
                                                     @endforeach
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div>
                                                       @foreach($order->items as $item)
                                                       {{$item->product->name}} ,
                                                       @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                              <a href="{{route('web.order.details',$order->id)}}">View Details</a>
                                            </td>
                                            <td>
                                                <div class="price">
                                                  @if($order->total_price_after_discount)
                                                  {{$order->total_price_after_discount}} EGP
                                                  @else
                                                    {{$order->total_price}} EGP
                                                    @endif
                                                </div>
                                            </td>
                                      
                                            <td>
                                                <div class="status-product">
                                                    <span>
                                                      @if($order->status == 2)
                                                      Confirmed
                                                      @elseif($order->status == 4)
                                                      In Progress
                                                      @elseif($order->status == 5)
                                                      Processed
                                                      @else
                                                      Not Defiend
                                                      @endif
                                                </span>
                                                </div>
                                            </td>
                                            <td>
                                              <form action="{{route('web.cancel.order')}}" method="post">
                                                 {{csrf_field()}}
                                                 <input type="hidden" name="order_id" value="{{$order->id}}">
                                                 <input type="submit" value="Cancel" style="backcolor: #484848">
                                              </form>
                                            </td>
                                        </tr>
                                     @endforeach

          </table>
          

        </div>
      </div>

    </div>
    <!-- /.shopping-cart -->
  </section>
@endsection
@section('scripts')
@endsection