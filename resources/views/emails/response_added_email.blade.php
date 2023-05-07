<x-mail::message>
# UCAS - Feedback Center

Hello, {{$name}}.<br>
Thanks for giving us your feedbacks. A response has been added to the feedback of ID {{$feedback_id}}. <br>
You will find the response message below.

<x-mail::panel>
# Feedback ID: {{$feedback_id}} <br>
# Response Message : {{$response}}
</x-mail::panel>

<x-mail::button :url="'http://127.0.0.1:8000/ucas/feedbacks/search'">
Track your Feedback
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
