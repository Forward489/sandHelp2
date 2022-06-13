@extends('layouts.main')

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
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    {{-- <p class="test-css">
            Halo Tes
        </p> --}}
    <form action="/account/login/post" method="post" id="demo-form">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password">
        </div>
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        {{-- <button type="submit" class="btn btn-primary d-flex justify-content-center">Submit</button> --}}
        <div class="text-center">
            {{-- <button type="submit" class="btn btn-primary text">Submit</button> --}}
            <button class="g-recaptcha btn btn-primary" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}"
                data-callback='onSubmit'>Submit</button>
        </div>
    </form>
    <script>
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
    </script>
    <div class="text-center">
        or
    </div>
    {{-- <a href="{{ route('googleLogin') }}" class="btn btn-danger justify-content-center">Login With Google</a> --}}
    <div class="text-center">
        <a href="{{ route('googleLogin') }}" class="btn btn-danger text">Login With Google</a>
    </div>
    <div class="text-center">
        Don't have an account ? <a href="/account/registration" class="text-decoration-none">Make one here !</a>
    </div>
    <div class="text-center">
        Forgot your password ? <a href="{{ route('forgotPasswordIndex') }}" class="text-decoration-none">Click here !</a>
    </div>
@endsection
