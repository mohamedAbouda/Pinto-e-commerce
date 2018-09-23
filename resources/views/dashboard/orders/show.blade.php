@extends('layouts.dashboard')

@section('title','Orders')

@section('stylesheets')
<style>
    .margin-top {
        margin-top:20px;
    }
    .table-responsive {
        width: 100%;
        overflow-y: hidden;
        overflow-x: scroll;
        -ms-overflow-style:
        -ms-autohiding-scrollbar;
        -webkit-overflow-scrolling: touch;
    }
</style>
@stop

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{ route('dashboard.orders.index') }}">Orders</a>
    </li>
    <li class="active">
        <strong>Order #{{ $resource->id }}</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">
    <header class="panel_header">
        <h2 class="title pull-left">Order #{{ $resource->id }} for the user "{{ $resource->name }}"</h2>
        @if($resource->state === 1)
        <h2 class="title"><span class="text-primary">Confirmed</span></h2>
        @elseif($resource->state === 2)
        <h2 class="title"><span class="text-danger">Canceled</span></h2>
        @elseif($resource->state === 3)
        <h2 class="title"><span class="text-info">Refunded</span></h2>
        @endif
    </header>

    <div class="content-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="col-lg-6 col-md-6">
                    <label for="name">
                        Client's name :
                    </label>
                    <input type="text" id="name" value="{{ $resource->name }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6">
                    <label for="name">
                        Email :
                    </label>
                    <input type="text" id="email" value="{{ $resource->email }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="phone">
                        Phone :
                    </label>
                    <input type="text" id="phone" value="{{ $resource->phone }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="company">
                        Company :
                    </label>
                    <input type="text" id="company" value="{{ $resource->company }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="address">
                        Address :
                    </label>
                    <input type="text" id="address" value="{{ $resource->address }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="address_2">
                        2nd optional address :
                    </label>
                    <input type="text" id="address_2" value="{{ $resource->address_2 }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="country">
                        Country :
                    </label>
                    <input type="text" id="country" value="{{ $resource->country->name }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="city">
                        City :
                    </label>
                    <input type="text" id="city" value="{{ $resource->city }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="zone">
                        Zone or Area :
                    </label>
                    <input type="text" id="zone" value="{{ $resource->zone }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="fax">
                        Fax :
                    </label>
                    <input type="text" id="fax" value="{{ $resource->fax }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="post_code">
                        Post code :
                    </label>
                    <input type="text" id="post_code" value="{{ $resource->post_code }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="price">
                        Price paid :
                    </label>
                    <input type="text" id="price" value="{{ $resource->price }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="paymentMethod">
                        Payment method :
                    </label>
                    <input type="text" id="paymentMethod" value="{{ $resource->paymentMethod->name }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="deliveryOption">
                        Delivery option :
                    </label>
                    <input type="text" id="deliveryOption" value="{{ $resource->deliveryOption->name }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="giftcard">
                        Giftcard code (if used) :
                    </label>
                    <input type="text" id="giftcard" value="{{ $resource->giftcard ? $resource->giftcard->code : '' }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="giftcard_value">
                        Giftcard discount used :
                    </label>
                    <input type="text" id="giftcard_value" value="{{ $resource->giftcard ? $resource->gift_card_value_taken : '' }}" class="form-control" disabled>
                </div>
                <div class="col-lg-6 col-md-6 margin-top">
                    <label for="coupon">
                        Coupon code (if used) :
                    </label>
                    <input type="text" id="coupon" value="{{ $resource->coupon ? $resource->coupon->code : '' }}" class="form-control" disabled>
                </div>
                <div class="clearfix"></div>
                <div class="margin-top">
                    <label for="comments">
                        Comments :
                    </label>
                    <p id="comments">“{{ $resource->comments }}”</p>
                </div>
            </div>
            <div class="col-md-12">
                <p class="desc">Send the user a message to let him/her/they know the state of the order.</p>
                <button type="button" class="btn btn-primary sendOrderStateChangeMailBtn" data-type="1">
                    Send order confirmation message
                </button>
                <button type="button" class="btn btn-danger sendOrderStateChangeMailBtn" data-type="2">
                    Cancel order message
                </button>
                <button type="button" class="btn btn-warning sendOrderStateChangeMailBtn" data-type="3">
                    Order refunded message
                </button>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="sendMessageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    Send a message to the user `{{ $resource->name }}`
                </h4>
            </div>
            {{ Form::open(['id' => 'sendOrderStateMessageForm' , 'route' => ['dashboard.orders.changeOrderState' , $resource->id]]) }}
            <div class="modal-body">
                <p class="text-primary message h4" style="display:none;">Order confirmation message:</p>
                <p class="text-danger message h4" style="display:none;">Order cancelation message:</p>
                <p class="text-info message h4" style="display:none;">Order refund message:</p>
                <textarea name="message" rows="15" style="width:100%;" placeholder="Write your message here."></textarea>
                <input type="hidden" name="type" value="0">
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<section class="box" id="cart">
    <header class="panel_header">
        <h2 class="title pull-left">
            <a href="#cart" class="text-primary">#</a> Order's cart
        </h2>
    </header>

    <div class="content-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Original price</th>
                                <th>Price paid at the time</th>
                                <th>Inventory</th>
                                <th>Category</th>
                                <th>Sub-category</th>
                                <th>Amount bought</th>
                                <th>Color</th>
                                <th>Size</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $offset = request()->get('page' , 1)*20 - 20;?>
                            @foreach($resource->products as $product)
                            <tr>
                                <td>{{ $offset + $loop->iteration }}</td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td width=100 height=100>
                                    <div class="thumbnail">
                                        <img class="img-responsive" src ="{{ url('storage/app/'.$product->image) }}">
                                    </div>
                                </td>
                                <td>
                                    ${{ $product->price }}
                                </td>
                                <td>
                                    ${{ $product->pivot->price_per_item }}
                                </td>
                                <td>
                                    {{ $product->inventory }}
                                </td>
                                <td>
                                    {{ $product->category->name }}
                                </td>
                                <td>
                                    {{ $product->subCategory ? $product->subCategory->name : '' }}
                                </td>
                                <td>
                                    {{ $product->pivot->amount }}
                                </td>
                                <td>
                                    <?php $color = $product->colors()->where('id' , $product->pivot->color_id)->first(); ?>
                                    {{ $color ? $color->name : '..' }}
                                </td>
                                <td>
                                    <?php $size = $product->sizes()->where('id' , $product->pivot->size_id)->first(); ?>
                                    {{ $size ? $size->name : '..' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="box" id="cart">
    <header class="panel_header">
        <h2 class="title pull-left">
            <a href="#cart" class="text-primary">#</a> Order's invoice
        </h2>
    </header>

    <div class="content-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>
                                Total price with no voucher/coupon :
                            </th>
                            <td class="text-primary">
                                {{ $resource->product->sum(function($e){ return $e->pivot->price_per_item * $e->pivot->amount; })}}
                            </td>
                        </tr>
                        @if($resource->giftcard)
                        <tr>
                            <th>
                                With giftcard :
                            </th>
                            <td class="text-primary">
                                - {{ $resource->gift_card_value_taken }}
                            </td>
                        </tr>
                        @endif
                        @if($resource->coupon)
                        <tr>
                            <th>
                                With coupon :
                            </th>
                            <td class="text-primary">
                                - %{{ $resource->coupon->percentage }}
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>
                                Delivery option tax :
                            </th>
                            <td class="text-primary">
                                + ${{ $resource->deliveryOption->price }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Total price paid :
                            </th>
                            <td class="text-primary">
                                {{ $resource->price }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
<script type="text/javascript">
    $(function(){
        $('.sendOrderStateChangeMailBtn').click(function(){
            var type = $(this).attr('data-type');
            $('#sendOrderStateMessageForm').find('.message').hide();
            if (type == 1) {
                $('#sendOrderStateMessageForm').find('.message:eq(0)').show();
            }else if (type == 2) {
                $('#sendOrderStateMessageForm').find('.message:eq(1)').show();
            }else{
                $('#sendOrderStateMessageForm').find('.message:eq(2)').show();
            }
            $('#sendOrderStateMessageForm').find('input[name=type]').val(type);
            $('#sendMessageModal').modal('show');
        });
    });
</script>
@stop
