@extends('layouts.site.app')

@section('content')
<div class="main-content space-padding-tb-70">
    <cart :cart="{{ json_encode($cart) }}"></cart>
</div>
@stop

@section('scripts')
{{ Html::script('assets/site/js/cart/cart.js') }}
@stop
