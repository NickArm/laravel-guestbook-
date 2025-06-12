@component('mail::message')
# Account Deactivated

Dear {{ $user->name }},

Your account on **Welcomy** has been deactivated by an administrator.

If you believe this was a mistake, please contact us at [support@welcomy.net](mailto:support@welcomy.net).

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
