@extends('layouts.main2')

@section('content')
    @include('layouts.popup')
    <h3 class="welcome pb-5">
        Welcome to SandHelp
    </h3>
    @if (session()->has('success'))
        <label class="inputLabel font-weight-light">{{ session('success') }}</label>
    @endif
    @if (session()->has('google_captcha_error'))
        <label class="inputLabel font-weight-light">{{ session('google_captcha_error') }}</label>
    @endif
    @if (session()->has('verified'))
        <label class="inputLabel font-weight-light">{{ session('verified') }}</label>
    @endif
    @if (session()->has('info'))
        <label class="inputLabel font-weight-light">{{ session('info') }}</label>
    @endif
    @if (session()->has('reregister'))
        <label class="inputLabel font-weight-light">{{ session('reregister') }}</label>
    @endif
    @if (session()->has('loginError'))
        {{-- <div class="animate__animated animate__fadeIn animate__">

        </div> --}}
        <label class="inputLabel font-weight-light">{{ session('loginError') }}</label>
        {{-- <label class="inputLabel font-weight-light">{{ session('loginError') }}</label> --}}
    @endif
    @if (session()->has('email_not_verified'))
        <label class="inputLabel font-weight-light">{{ session('email_not_verified') }}</label>
    @endif
    @if (session()->has('invalid_verification'))
        <label class="inputLabel font-weight-light">{{ session('invalid_verification') }}</label>
    @endif
    @if (session()->has('logged out'))
        <label class="inputLabel font-weight-light">{{ session('logged out') }}</label>
    @endif
    <div class="inputWrapper text-left">
        <form action="/account/login/post" class="form-group" method="POST" id="demo-form">
            @csrf
            <label for="email" class="inputLabel font-weight-bold"
                onclick="showPopup('Please verify your email')">Email</label> <br>
            <input type="email" name="email" id="email" placeholder="Type your email" class="inputBox"
                value="{{ old('email') }}">
            @error('email')
                <br>
                <label for="email" class="inputLabel font-weight-light">{{ $message }}</label>
            @enderror
            <br>
            <label for="password" class="inputLabel font-weight-bold pt-2">Password</label><br>
            <input type="password" name="password" id="password" placeholder="Type your password" class="inputBox">
            @error('password')
                <br>
                <label for="password" class="inputLabel font-weight-light">{{ $message }}</label>
            @enderror
            <div class="text-right pt-3">
                <a href="{{ route('forgot_password_trial') }}" class="forget-password">Forgot Password?</a>
            </div>
            <br>
            <div class="text-center pt-3">
                <button class="g-recaptcha sign-in" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}"
                    data-callback='onSubmit'>Submit</button>
                <style>
                    .grecaptcha-badge {
                        visibility: hidden;
                    }
                </style>
                <script>
                    function onSubmit(token) {
                        document.getElementById("demo-form").submit();
                    }
                </script>
                {{-- <input type="submit" name="" id="" class="sign-in" value="Sign in"> --}}
            </div>
        </form>
    </div>
    <div class="or">
        <hr>
        <p>or</p>
    </div>
    <br>

    <button class="mt-4 mb-5 google">
        <a href="{{ route('googleLogin') }}" class="text-decoration-none text-white">
            <i class="fa fa-google pr-2" aria-hidden="true" style="color:white;"></i>
            Sign up with google
        </a>
    </button>

    <p class="create-account">New sand warrior? <a href="{{ route('regist_trial') }}">Create account</a> </p>
@endsection
