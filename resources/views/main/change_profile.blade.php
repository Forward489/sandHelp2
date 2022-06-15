@extends('layouts.main')

@section('container')
    @if (session()->has('updated'))
        <div class="alert alert-primary" role="alert">
            {{ session('updated') }}
        </div>
    @endif
    {{-- <h2>This is the update profile page</h2> --}}
    <form action="{{ route('submit_edit') }}" method="post" id="demo-form" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <h2 class="mb-1">{{ auth()->user()->name }}</h2>
            <h2>{{ auth()->user()->points }} points</h2>
        </div>

        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
        {{-- <div class="mb-3">
            <label for="profile_picture" class="form-label">Change Profile Picture</label>
            <input class="form-control" type="file" id="profile_picture" name="profile_picture">
        </div> --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description about you</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ auth()->user()->description }}</textarea>
            @error('description')
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
