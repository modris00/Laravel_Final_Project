<x-mail::message>
# UCAS - Feedback Center

Hello, {{$name}}.<br>
Thanks for giving us your feedback. Below is the ID of your feedback in case you wanted to track it.

<x-mail::panel>
# Feedback ID : {{$feedback_id}}
</x-mail::panel>

<x-mail::button :url="'http://127.0.0.1:8000/ucas/feedbacks/search'">
Feedback Search Page
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>


{{-- <x-mail::message>
# UCAS 104

Welcome {{$name}} in UCAS-104 System

<x-mail::panel>
Your email is: {{$email}}
</x-mail::panel>

<x-mail::button :url="'http://127.0.0.1:8000/cms/admin/login'">
Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> --}}
