@extends('testing.layouts.main_account')

@section('container')
    @if (session()->has('existing_alert'))
        <div id="popup" class="popup animate__animated animate__fadeIn text-left" onload="">
            <img src="/Images/tanda_seru.png" width="50px" alt="" id="tanda_seru">
            <div id="message" style="display: inline;">
                {{ session('existing_alert') }}
            </div>
            <script>
                showPopup()
            </script>
        </div>
    @endif
    @if (session()->has('google_captcha_error'))
        <div id="popup" class="popup animate__animated animate__fadeIn text-left" onload="">
            <img src="/Images/tanda_seru.png" width="50px" alt="" id="tanda_seru">
            <div id="message" style="display: inline;">
                {{ session('google_captcha_error') }}
            </div>
            <script>
                showPopup()
            </script>
        </div>
    @endif
    <h3 class="welcome pb-5">
        Create Account
    </h3>
    <form action="/account/registration" method="post" id="demo-form" class="form-group">
        @csrf
        <div class="inputWrapper1 text-left" id="inputWrapper1">
            <div class="form-group">
                <label for="name" class="inputLabel font-weight-bold">Full Name</label> <br>
                <input type="text" name="name" id="name" placeholder="Type your full name" class="inputBox">
                @error('name')
                    <br>
                    <label for="name" style="color: red" class="inputLabel font-weight-bold">{{ $message }}</label>
                @enderror
                <br>
                <label for="email" class="inputLabel font-weight-bold pt-2">Email</label><br>
                <input type="email" name="email" id="email" placeholder="Type your email" class="inputBox"><br>
                @error('email')
                    <br>
                    <label for="email" style="color: red" class="inputLabel font-weight-bold">{{ $message }}</label>
                @enderror
                <br>
                <div class="text-center pt-3">
                    <button class="next" type="button" onclick="next()">
                        Next
                    </button>
                </div>
            </div>
        </div>
        <div class="inputWrapper2 text-left" id="inputWrapper2">
            <div class="form-group">
                <label for="birthdate" class="inputLabel font-weight-bold">Date of Birth</label> <br>
                <input type="date" name="birthdate" id="birthdate" placeholder="" class="inputBox" style="">
                @error('birthdate')
                    <br>
                    <label for="birthdate" style="color: red" class="inputLabel font-weight-bold">{{ $message }}</label>
                @enderror
                <br>
                <label for="gender" class="inputLabel font-weight-bold">Gender</label> <br>
                <input type="radio" name="gender" value="M" class="mt-3" style=" accent-color: #c28400;">
                <div class="mr-3"
                    style="display: inline;
                color:#c28400;
                font-weight: bold;
                ">
                    Male</div>
                <input type="radio" name="gender" value="F" class="mt-3 ml-5" style=" accent-color: #c28400;">
                <div
                    style="display:inline;
                color:#c28400;
                font-weight:bold;
                ">
                    Female</div>
                @error('gender')
                    <br>
                    <label for="gender" style="color: red" class="inputLabel font-weight-bold">{{ $message }}</label>
                @enderror
                <br>
                <label for="password" class="inputLabel font-weight-bold">Password</label> <br>
                <div>
                    <input type="password" name="password" id="password" placeholder="Type your password" class="inputBox">
                    <i class="fa fa-eye-slash" id="see_password" aria-hidden="true" data-is_password=true></i>
                    @error('password')
                        <br>
                        <label for="password" style="color: red" class="inputLabel font-weight-bold">{{ $message }}</label>
                    @enderror
                </div>
                <br>
                <label for="password_confirmation" class="inputLabel font-weight-bold pt-2">Confirm
                    Password</label><br>
                <div>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirm your password" class="inputBox">
                    <i class="fa fa-eye-slash" id="see_password" aria-hidden="true" data-is_password=true></i>
                    @error('password_confirmation')
                        <br>
                        <label for="password_confirmation" style="color: red" class="inputLabel font-weight-bold">{{ $message }}</label>
                    @enderror
                </div>

                <br>
                <div class="text-center">
                    {{-- <input type="submit" name="" id="" class="register" value="Register now"> --}}
                    <button class="g-recaptcha register" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}"
                        data-callback='onSubmit'>Submit</button>

                </div>
                <div class="text-center pt-3">
                    <a onclick="previous()" class="text-center" style="color: #c28400">Previous</a>


                </div>

            </div>
        </div>
    </form>

    <div class="or">
        <hr>
        <p>or</p>
    </div>
    <br>

    <a href="{{ route('googleLogin') }}" class="text-decoration-none text-white">
        <button class="mt-4 mb-5 google">
            <i class="fa fa-google pr-2" aria-hidden="true" style="color:white;"></i>
            Sign up with google
        </button>
    </a>

    <p class="have-account">Certified sand warrior?<a href="{{ route('login_trial') }}"> Sign in</a> </p>

    <style>
        .grecaptcha-badge {
            visibility: hidden;
        }
    </style>

    <script>
        page1 = document.getElementById("inputWrapper1");
        page2 = document.getElementById("inputWrapper2");

        function next() {
            page1.style.display = "none";
            page2.style.display = "flex";
        }

        function previous() {
            page2.style.display = "none";
            page1.style.display = "flex";
        }

        $(document).ready(function() {
            //id sesuaiin kebutuhan
            $(document).on('click', '#see_password', function() {
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
