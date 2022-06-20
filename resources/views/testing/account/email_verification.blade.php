@extends('layouts.main')


@section('verify')
    <style>
        #main_navbar {
            visibility: hidden;
        }
    </style>

    <form action="{{ route('emailVerControl') }}" method="post">
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        @csrf
        <button type="submit" class="btn btn-primary">Verify E-mail</button>
    </form>
@endsection
