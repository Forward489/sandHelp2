@extends('layouts.main')

@section('container')
    <h2>Welcome to home page</h2>
    @auth
        @if (!auth()->user()->profile_picture)
            <img src="{{ auth()->user()->avatar }}" alt="">
        @else
            <div style="max-height: 150px; max-width: 150px; overflow: hidden;">
                <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}" alt="">
            </div>
        @endif
        <div class="m-2">
            <p>{{ auth()->user()->description }}</p>
        </div>
    @endauth
@endsection
