@extends('testing.layouts.main_account')

@section('container')
    @if (session()->has('sent'))
        <div class="alert alert-primary" role="alert">
            {{ session('sent') }}
        </div>
    @endif
    @if (session()->has('google_logged'))
        <div class="alert alert-danger" role="alert">
            {{ session('google_logged') }}
        </div>
    @endif
    <h3 class="welcome pb-1">
        Forgot your password
    </h3>
    <!-- Title end -->

    <!-- Icon -->
    <img src="/Images/forget_pass.png" alt="" width="200px" class="pt-3 pb-3">
    <!-- Icon end -->

    <br>

    <div class="dont-worry-box ">
        <p>Please Enter your email address. <br> We will send you an mail to reset your password</p>
    </div>
    <div class="inputWrapper text-left">

        <form action="{{ route('forgotPassword') }}" class="form-group" method="POST">
            @csrf
            <label for="email" class="inputLabel font-weight-bold">Email</label> <br>
            <input type="email" name="email" id="email" placeholder="Type your email" class="inputBox">
            @error('email')
                <br>
                <label for="email" class="inputLabel font-weight-bold">{{ $message }}</label>
            @enderror
            <br>
            <div class="text-center pt-3">
                <input type="submit" class="reset" value="Reset">
            </div>
        </form>
    </div>
    <div class="or">
        <hr>
        <p>or</p>
    </div>
    <br>

    <!-- Sign in option -->
    <p class="suddenly-remember pt-2">Remembered your password? <a href="{{ route('login_trial') }}">Sign in</a> </p>
    @if (session()->has('google_logged'))
        <p class="suddenly-remember pt-2"><a href="/account/registration">Register here !</a></a></p>
    @endif
    <!-- Sign in option end -->
@endsection
