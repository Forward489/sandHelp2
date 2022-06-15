@extends('layouts.main2')

@section('content')
    <div class="dont-worry-box ">
        <p>Please Enter your email address. <br> We will send you an mail to reset your password</p>
    </div>
    <div class="inputWrapper text-left">
        <form action="{{ route('forgotPassword') }}" class="form-group" method="POST">
            @csrf
            <label for="email" class="inputLabel font-weight-bold">Email</label>
            <br>
            <input type="email" name="email" id="email" placeholder="Type your email" class="inputBox" value={{ old('email') }}>
            @error('email')
                <br>
                <label for="email" class="inputLabel font-weight-light">{{ $message }}</label>
            @enderror
            <br>
            <div class="text-center pt-3">
                <button class="g-recaptcha register" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}"
                    data-callback='onSubmit'>Submit</button>

                <style>
                    .grecaptcha-badge {
                        visibility: hidden;
                    }
                </style>
                {{-- <button class="g-recaptcha btn btn-primary" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}" data-callback='onSubmit'>Submit</button> --}}
                {{-- <button class="g-recaptcha register" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}"
                    data-callback='onSubmit'>Register now</button> --}}
                <script>
                    function onSubmit(token) {
                        document.getElementById("demo-form").submit();
                    }
                </script>
            </div>
        </form>
    </div>
    <div class="or">
        <hr>
        <p>or</p>
    </div>
    <br>
    <p class="suddenly-remember pt-2">Remembered your password? <a href="{{ route('login_trial') }}">Sign in</a> </p>
@endsection
