@component('mail::message')
# You have requested a reset for your password.


Please click the button if you really want to change your password


@component('mail::button', ['url' => route('web.client.reset.password',$token)])
Click here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
