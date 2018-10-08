@extends('layouts.site.app')

@section('content')
<div class="main-content space-padding-tb-70">
    <checkout :cart="{{ json_encode($cart) }}" :shipping_methods="{{ json_encode($shipping_methods) }}" :checkout_url="{{ json_encode(route('web.cart.checkout')) }}" :addresses="{{ json_encode($addresses) }}" :countries="{{ json_encode($countries) }}" :client="{{ json_encode($client) }}"></checkout>
</div>
<!-- end main content-->
@stop

@section('scripts')
{{ Html::script('assets/site/js/cart/cart.js') }}
@stop
