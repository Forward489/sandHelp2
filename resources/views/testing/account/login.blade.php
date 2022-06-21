@extends('testing.layouts.main_account')

{{-- {{ HTML::style('css/app.css'); }} --}}
@section('container')
    @if (session()->has('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('google_captcha_error'))
        <div class="alert alert-danger" role="alert">
            {{ session('google_captcha_error') }}
        </div>
    @endif
    @if (session()->has('verified'))
        <div class="alert alert-primary" role="alert">
            {{ session('verified') }}
        </div>
    @endif
    @if (session()->has('info'))
        <div class="alert alert-success" role="alert">
            {{ session('info') }}
        </div>
    @endif
    @if (session()->has('reregister'))
        <div class="alert alert-warning" role="alert">
            {{ session('reregister') }}
        </div>
    @endif
    @if (session()->has('loginError'))
        <div class="alert alert-danger" role="alert">
            {{ session('loginError') }}
        </div>
    @endif
    @if (session()->has('email_not_verified'))
        <div class="alert alert-danger" role="alert">
            {{ session('email_not_verified') }}
        </div>
    @endif
    @if (session()->has('invalid_verification'))
        <div class="alert alert-danger" role="alert">
            {{ session('invalid_verification') }}
        </div>
    @endif
    @if (session()->has('logged out'))
        <div class="alert alert-success" role="alert">
            {{ session('logged out') }}
        </div>
    @endif
    {{-- <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}"> --}}
    {{-- <p class="test-css">
            Halo Tes
        </p> --}}
    <!-- Title -->
    <h3 class="welcome pb-5">
        Welcome to SandHelp
    </h3>
    <!-- Title end -->

    <!-- Form wrapper -->
    <div class="inputWrapper text-left">
        <form action="/account/login/post" method="post" id="demo-form" class="form-group">
            @csrf
            <label for="email" class="inputLabel font-weight-bold">Email</label>
            <br>
            {{-- <label for="email" class="inputLabel font-weight-bold"
                onclick="showPopup('Please verify your email')">Email</label> <br> --}}
            <input type="email" name="email" id="email" placeholder="Type your email" class="inputBox">
            @error('email')
                <br>
                <label for="email" class="inputLabel font-weight-bold">{{ $message }}</label>
            @enderror
            <br>
            <label for="password" class="inputLabel font-weight-bold pt-2">Password</label><br>
            <input type="password" name="password" id="password" placeholder="Type your password" class="inputBox">
            <i class="fa fa-eye-slash" id="see_password" aria-hidden="true" data-is_password=true></i>
            @error('password')
                <br>
                <label for="password" class="inputLabel font-weight-bold">{{ $message }}</label>
            @enderror
            <br>
            <div class="text-right pt-3">
                <a href="{{ route('forgot_password_trial') }}" class="forget-password">Forgot Password?</a>
            </div>
            <br>
            <div class="text-center pt-3">
                {{-- <input type="submit" name="" id="" class="sign-in" value="Sign in"> --}}
                <button class="g-recaptcha sign-in" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}"
                    data-callback='onSubmit'>Submit</button>
            </div>
        </form>
    </div>
    <!-- Form wrapper end -->
    <div class="or">
        <hr>
        <p>or</p>
    </div>
    <br>

    <a href="{{ route('googleLogin') }}" class="text-decoration-none text-white">
        <button class="mt-4 mb-5 google">
            <i class="fa fa-google pr-2" aria-hidden="true" style="color:white;"></i>
            Sign in with google
        </button>
    </a>

    {{-- <button class="mt-4 mb-5 google">
        <i class="fa fa-google pr-2" aria-hidden="true" style="color:white;"></i>
        Sign in with google
    </button> --}}

    <p class="create-account">New sand warrior? <a href="{{ route('regist_trial') }}">Create account</a> </p>

    <style>
        .grecaptcha-badge {
            visibility: hidden;
        }
    </style>

    <script>
        $(document).ready(function() {
            //id sesuaiin kebutuhan
            $(document).on('click', '#see_password', function() {
                if ($(this).data('is_password')) {
                    $(this).parent().find('input[type=password]').attr('type', 'text');
                    $(this).data('is_password', false)
                } else {
                    $(this).parent().find('input[type=text]').attr('type', 'password');
                    $(this).data('is_password', true)
                }
                $(this).toggleClass('fa-eye fa-eye-slash')
            })
        });

        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
    </script>
@endsection
