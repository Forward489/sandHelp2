@extends('testing.layouts.main_account')


@section('container')
    <h3 class="welcome pb-5">
        Change your Password
    </h3>
    <style>
        .grecaptcha-badge {
            visibility: hidden;
        }
    </style>
    <div class="inputWrapper text-left" >
        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
        <form action="/account/change_password" method="post" class="form-group" id="demo-form">
            @csrf
            <label for="old_password" class="inputLabel font-weight-bold">Old Password</label>
            <br>
            <div>
                <input type="password" name="old_password" id="old_password" placeholder="Type your old password" class="inputBox">
                <i class="fa fa-eye-slash" id="see_password" aria-hidden="true" data-is_password=true></i>
                @error('old_password')
                    <br>
                    <label for="old_password" class="inputLabel font-weight-bold">{{ $message }}</label>
                @enderror
            </div>

            <br>

            <label for="new-password" class="inputLabel font-weight-bold">New Password</label>
            <br>
            <div>
                <input type="password" name="password" id="password" placeholder="Type your new password" class="inputBox">
                <i class="fa fa-eye-slash" id="see_password" aria-hidden="true" data-is_password=true></i>
                @error('password')
                    <br>
                    <label for="password" class="inputLabel font-weight-bold">{{ $message }}</label>
                @enderror
            </div>

            <br>
            <label for="password_confirmation" class="inputLabel font-weight-bold pt-2">Confirm New Password</label><br>
            <div>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your new Password"
                    class="inputBox">
                <i class="fa fa-eye-slash" id="see_password" aria-hidden="true" data-is_password=true></i>
                @error('password_confirmation')
                    <br>
                    <label for="password_confirmation" class="inputLabel font-weight-bold">{{ $message }}</label>
                @enderror
            </div>

            <br>
            <div class="text-center pt-3 pb-5">
                {{-- <input type="submit" name="" id="" class="reset" value="Reset"> --}}
                <button class="g-recaptcha reset" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}"
            data-callback='onSubmit'>Reset</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            //id sesuaiin kebutuhan
            $(document).on('click', '#see_password', function () {
                if ($(this).data('is_password')) {
                    $(this).parent().find('input[type=password]').attr('type', 'text');
                    $(this).data('is_password', false)
                } else {
                    $(this).parent().find('input[type=text]').attr('type', 'password');
                    $(this).data('is_password', true)
                }
                $(this).toggleClass('fa-eye fa-eye-slash')
            })
        });

        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
    </script>
@endsection

@section('footer')
    @include('testing.layouts.landing_footer')
@endsection