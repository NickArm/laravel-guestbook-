@component('mail::message')
# Your Account is Now Active 🎉

Hello {{ $user->name }},

Your Welcomy account has been successfully activated by an administrator.

You can now log in and manage your property:

@component('mail::button', ['url' => route('login')])
Log in to Welcomy
@endcomponent

Thank you,<br>
The Welcomy Team
@endcomponent
