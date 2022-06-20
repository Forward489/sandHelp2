@extends('layouts.main')

@section('container')
    @if (session()->has('password_not_match'))
        <div class="alert alert-danger" role="alert">
            {{ session('password_not_match') }}
        </div>
    @endif
    <form action="/account/change_password" method="post" id="demo-form">
        @csrf
        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
        <div class="mb-3">
            <label for="old_password" class="form-label">Old Password</label>
            <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password"
                aria-describedby="emailHelp" value="{{ old('old_password') }}" name="old_password">
            <button type="button" class="btn btn-primary d-inline" id="see_password_old" data-is_password=true>See
                password</button>
            @error('old_password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password">
            <button type="button" class="btn btn-primary d-inline" id="see_password_old" data-is_password=true>See
                password</button>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">New Password Confirm</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                id="password_confirmation" name="password_confirmation">
            <button type="button" class="btn btn-primary d-inline" id="see_password_old" data-is_password=true>See
                password</button>
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

        // $(document).ready(function() {
        //     var is_text = false;
        //     $(document).on('click', '#see_password_old', function() {
        //         if ($(this).data('is_password')) {
        //             $(this).parent().find('input[type=password]').attr('type', 'text');
        //             $(this).data('is_password', false)
        //         } else {
        //             $(this).parent().find('input[type=text]').attr('type', 'password');
        //             $(this).data('is_password', true)
        //         }
        //     })
        // });
    </script>
@endsection
