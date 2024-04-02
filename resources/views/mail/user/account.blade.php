<style>
    .otp-code {
        font-size: 35px;
        font-weight: bold;
        margin-top: 20px;
        letter-spacing: 10px;
        color: #282F3B;
    }
</style>

<x-mail::message>

    Hello {{ $name }},

    Your account with {{ config('app.name') }} as a {{ $role }} has been created.

    Please use the following as your password for login into :
    {{ $password }}


    Click the button below to login.
    <x-mail::button :url="$url">
        Login
    </x-mail::button>

    if you did not create an account with {{ config('app.name') }}, no further action is required.

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>