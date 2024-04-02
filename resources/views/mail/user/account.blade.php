
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

    Your account has been created on   {{ config('app.name') }} as a {{ $role }}.

    Please use the following as your password for login into :
     {{ $password }}


    Thanks
    {{ config('app.name') }}
</x-mail::message>