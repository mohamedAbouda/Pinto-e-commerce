@component('mail::message')
Your verification Code 

The verification code is {{$code}}



Thanks,<br>
{{ config('app.name') }}
@endcomponent
