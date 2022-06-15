@extends('layouts.main2')

@section('content')
    {{-- @if (!empty(session()))

    @endif --}}
    @if (session()->has('existing_alert'))
        {{-- @include('layouts.popup')
        <div onload="showPopup({{ session('existing_alert') }})">
        </div> --}}
        <div class="alert alert-danger" role="alert">
            {{ session('existing_alert') }}
        </div>
    @endif
    @if (session()->has('google_captcha_error'))
        {{-- @include('layouts.popup')
        <div onload="showPopup({{ session('existing_alert') }})"></div> --}}
        <div class="alert alert-danger" role="alert">
            {{ session('google_captcha_error') }}
        </div>
    @endif
    <h3 class="welcome pb-5">
        Create Account
    </h3>
    <form action="/account/registration" method="POST" class="form-group" id="demo-form">
        @csrf
        <div class="inputWrapper1 text-left" id="inputWrapper1">
            <div class="form-group">
                <label for="name" class="inputLabel font-weight-bold">Full Name</label> <br>
                <input type="text" name="name" id="name" placeholder="Type your full name" class="inputBox"
                    value="{{ old('name') }}">
                @error('name')
                    <br>
                    <label for="name" class="inputLabel font-weight-light">{{ $message }}</label>
                @enderror
                <br>
                <label for="email" class="inputLabel font-weight-bold pt-2">Email</label><br>
                <input type="email" name="email" id="email" placeholder="Type your email" class="inputBox"
                    value="{{ old('email') }}">
                @error('email')
                    <br>
                    <label for="email" class="inputLabel font-weight-light">{{ $message }}</label>
                @enderror
                <br>
                <br>
                <div class="text-center pt-3">
                    <button class="next" type="button" onclick="next()">
                        Next
                    </button>
                </div>
            </div>
        </div>
        <div class="inputWrapper2 text-left" id="inputWrapper2">
            <div class="form-group">
                <label for="password" class="inputLabel font-weight-bold">Password</label> <br>
                <input type="password" name="password" id="password" placeholder="Type your password"
                    class="inputBox">
                @error('password')
                    <br>
                    <label for="password" class="inputLabel font-weight-light">{{ $message }}</label>
                @enderror
                <br>
                <label for="password_confirmation" class="inputLabel font-weight-bold pt-2">Confirm
                    Password</label><br>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Retype your password" class="inputBox">
                @error('password_confirmation')
                    <br>
                    <br>
                    <label for="password_confirmation" class="inputLabel font-weight-light d-inline">{{ $message }}</label>
                    <br>
                @enderror
                <br>
                <div class="text-right pt-3">
                </div>
                <br>
                {{-- <div class="text-center pt-3">
                    <input type="submit" name="submit" id="" class="register" value="Register now">
                </div> --}}
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
                <div class="text-center pt-3">
                    <a onclick="previous()" class="text-center" style="color: #c28400">Previous</a>
                </div>

            </div>
        </div>
    </form>

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

    <p class="have-account">Certified sand warrior?<a href="{{ route('login_trial') }}"> Sign in</a> </p>

    <script>
        page1 = document.getElementById("inputWrapper1");
        page2 = document.getElementById("inputWrapper2");

        function next() {
            page1.style.display = "none";
            page2.style.display = "flex";
        }

        function previous() {
            page2.style.display = "none";
            page1.style.display = "flex";
        }
    </script>
@endsection
