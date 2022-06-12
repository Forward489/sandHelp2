@extends('layouts.main')

@section('container')
    <h2>Welcome to landing page</h2>
    @auth
        <img src="{{ auth()->user()->avatar }}" alt="">
    @endauth
@endsection
