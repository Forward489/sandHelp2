@extends('layouts.main')

@section('container')
    <h2>Welcome to landing page</h2>
    @auth
        <img src="{{ auth()->user()->avatar }}" alt="">
        <div class="m-2">
            <p>{{ auth()->user()->description }}</p>
        </div>
    @endauth
@endsection
