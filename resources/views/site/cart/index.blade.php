@extends('layouts.site.app')

@section('content')
<div class="main-content space-padding-tb-70">
    <cart :cart="{{ json_encode($cart) }}" :shipping_methods="{{ json_encode($shipping_methods) }}" :checkout_url="{{ json_encode(route('web.cart.update')) }}"></cart>
</div>
@stop

@section('scripts')
{{ Html::script('assets/site/js/cart/cart.js') }}
@stop
