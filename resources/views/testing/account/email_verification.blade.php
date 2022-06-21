@extends('testing.layouts.main_account')


@section('container')

    <form action="{{ route('emailVerControl') }}" method="post" id="demo-form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="card-container text-center">
            <img src="/Images/verify_email.png" class="icon" alt="">
            <h2 class="title">
                Click the button below
                <br> to verify your Email
            </h2>
            {{-- <button type="submit" class="button-redirect">Verify Email</button> --}}
            <button class="g-recaptcha button-redirect" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}"
            data-callback='onSubmit'>Verify E-mail</button>
        </div>
        {{-- <button type="submit" class="btn btn-primary">Verify E-mail</button> --}}
    </form>

    <script>
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
    </script>
@endsection
