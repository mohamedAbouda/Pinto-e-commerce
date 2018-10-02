@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Whoops!
@else
# Hello!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@if (isset($actionText))
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endif

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}
@endforeach

<table class="table">
    <thead>
        <tr>
            <td>
                Product name
            </td>
            <td>
                Brand
            </td>
            <td>
                Amount
            </td>
            <td>
                Price per unit
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach($order->product as $p)
        <tr>
            <td>
                {{ $p->name }}
            </td>
            <td>
                {{ $p->brand ? $p->brand->name : '' }}
            </td>
            <td>
                {{ $p->pivot->amount }}
            </td>
            <td>
                {{ $p->price }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<table class="table">
    <tbody>
        <tr>
            <td>Total cart price :</td>
            <td>
                {{ $order->product->sum(function($e){ return $e->pivot->price_per_item * $e->pivot->amount; })}}
            </td>
        </tr>
        <tr>
            <td>Giftcard discount :</td>
            <td>
                - {{ $order->gift_card_value_taken }}
            </td>
        </tr>
        <tr>
            <td>Coupon discount :</td>
            <td>
                {{ $order->coupon?$order->coupon->percentage:0 }} %
            </td>
        </tr>
        <tr>
            <td>Delivery option cost :</td>
            <td>
                + {{ $order->deliveryOption?$order->deliveryOption->price:0 }}
            </td>
        </tr>
        <tr>
            <td>Total :</td>
            <td>
                {{ $order->price }}
            </td>
        </tr>
    </tbody>
</table>

<!-- Salutation -->
@if (! empty($salutation))
{{ $salutation }}
@else
Regards,<br>{{ config('app.name') }}
@endif

<!-- Subcopy -->
@if (isset($actionText))
@component('mail::subcopy')
If you’re having trouble clicking the "{{ $actionText }}" button, copy and paste the URL below
into your web browser: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endif
@endcomponent
