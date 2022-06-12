@extends('layouts.main')

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
    <form action="{{ route('forgotPassword') }}" method="post">
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div class="text-center">or <a href="/account/login" class="text-decoration-none">Login here !</a></div>
    @if (session()->has('google_logged'))
        <a href="/account/registration" class="text-center text-decoration-none">Register here !</a>
    @endif
@endsection
