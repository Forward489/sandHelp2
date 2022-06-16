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
            {{-- @php 
                $age = Carbon::parse(auth()->user()->birthdate);
                $age = $age->age;
            @endphp --}}
            {{-- @dd(auth()->user()->birthdate) --}}
            @if (auth()->user()->birthdate)
                <h2>{{ \Carbon\Carbon::parse(auth()->user()->birthdate)->age }} years old</h2>
            @else
                <h2>You have to set your birthdate first</h2>
            @endif

            @if (auth()->user()->gender == 'M')
                <h2>Gender : Male</h2>
            @elseif(auth()->user()->gender == 'F')
                <h2>Gender : Female</h2>
            @else
                <h2>You need to set your gender first</h2>
            @endif
        </div>

        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Change Profile Picture</label>
            <input class="form-control @error('profile_picture') is-invalid @enderror" type="file" id="profile_picture"
                name="profile_picture" value="">
            @error('profile_picture')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description about you</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ auth()->user()->description }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @if (!auth()->user()->birthdate)
            <div class="mb-3">
                <label for="birthdate" class="form-label @error('birthdate') is-invalid @enderror">Birthday:</label>
                <input type="date" id="birthdate" name="birthdate" class="form-control">
                @error('birthdate')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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
                    @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        @endif
        @if (!auth()->user()->password)
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
        @endif
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
