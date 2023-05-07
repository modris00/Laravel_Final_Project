<x-mail::message>
# UCAS - New Supervisor Welcome

Hello, {{$name}}.<br>
A new supervisor account has been registered using your email ({{$email}}). <br>
Here's the password:
<x-mail::panel>
# New Account Password : {{$password}}
</x-mail::panel>

<x-mail::button :url="'http://127.0.0.1:8000/ucas/dashboard/'">
Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
