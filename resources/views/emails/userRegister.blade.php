@component('mail::message')
# Introduction
{{$user['email']}} welcome
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
