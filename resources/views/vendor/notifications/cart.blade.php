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
                Color
            </td>
            <td>
                Size
            </td>
            <td>
                Price per unit
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach($cart->items as $p)
        <tr>
            <td>
                {{ $p->name }}
            </td>
            <td>
                {{ $p->brand ? $p->brand->name : '..' }}
            </td>
            <td>
                {{ $p->pivot->amount }}
            </td>
            <td>
                <?php $color = $p->colors()->where('id' , $p->pivot->color_id)->first(); ?>
                {{ $color ? $color->name : '..' }}
            </td>
            <td>
                <?php $size = $p->sizes()->where('id' , $p->pivot->size_id)->first(); ?>
                {{ $size ? $size->name : '..' }}
            </td>
            <td>
                {{ $p->price }}
            </td>
        </tr>
        @endforeach
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
