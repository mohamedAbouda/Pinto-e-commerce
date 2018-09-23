@component('mail::message')
# You have requested a reset for your password.


Please click the link if you really want to change your password


@component('mail::button', ['url' => route('client.reset.password',$token)])
Click here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
