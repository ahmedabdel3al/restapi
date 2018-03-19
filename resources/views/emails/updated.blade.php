
@component('mail::message')
    welcome {{$user->name}}

    please verify a new  account from here

    @component('mail::button', ['url' => route('verify',$user->verification_token)])
        Verify Account
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

