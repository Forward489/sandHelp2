<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="agd-partner-manual-verification" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}"> --}}
    {{-- <link rel="stylesheet" href="/css/app.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>{{ $title }}</title>
</head>

<body>
    @include('layouts.navbar')
    {{-- @auth
        @if (auth()->user()->is_verified)
            <div class="container mt-3">
                @yield('container')
            </div>
        @else
            <div class="container mt-3">
                <div class="alert alert-primary" role="alert">
                    You need to verify your e-mail first !
                </div>
            </div>
        @endif
    @else --}}
    <div class="container mt-3">
        @yield('container')
    </div>
    {{-- @endauth --}}
    <div class="container mt-3">
        @yield('verify')
    </div>

</body>

</html>
