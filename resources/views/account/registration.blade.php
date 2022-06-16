@extends('layouts.main')

@section('container')
    @if (session()->has('existing_alert'))
        <div class="alert alert-danger" role="alert">
            {{ session('existing_alert') }}
        </div>
    @endif
    @if (session()->has('google_captcha_error'))
        <div class="alert alert-danger" role="alert">
            {{ session('google_captcha_error') }}
        </div>
    @endif
    <form action="/account/registration" method="post" id="demo-form">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                aria-describedby="emailHelp" value="{{ old('email') }}" name="email">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Full name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}"
                name="name">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div id="emailHelp" class="form-text">Disclaimer : Name will be overwritten in case you have logged in with
                Google already. If so and you don't want to change your name, let it be blank.</div>
        </div>
        <div class="mb-3">
            <label for="birthdate" class="form-label">Birthday:</label>
            <input type="date" id="birthdate" name="birthdate" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-check-label mb-1">
                Gender
            </label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="gender" value="M">
                <label class="form-check-label" for="gender">
                    Male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="gender_f" value="F">
                <label class="form-check-label" for="gender_f">
                    Female
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Password Confirm</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                id="password_confirmation" name="password_confirmation">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
        <button class="g-recaptcha btn btn-primary" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}"
            data-callback='onSubmit'>Submit</button>
    </form>

    <script>
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
    </script>
@endsection
