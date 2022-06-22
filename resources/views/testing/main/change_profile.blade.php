@extends('testing.main.profile_template')

@section('container')
    @if (session()->has('updated'))
        <div class="alert alert-primary" role="alert">
            {{ session('updated') }}
        </div>
    @endif
    @if (session()->has('password_updated'))
        <div class="alert alert-primary" role="alert">
            {{ session('password_updated') }}
        </div>
    @endif

    <div class="profile-card">
        <div class="profile-header text-center">
            <div style="border-bottom: 2px solid #c28400;">
                <a href="/"><img src="/Images/logo.png" alt="" class="logo"></a>
            </div>

            @if (auth()->user()->profile_picture)
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" id="output" alt="" class="profile-photo">
            @else
                <img src="/profilePhotos/stock.png" id="output" alt="" class="profile-photo">
            @endif

            {{-- <h3 class="name">Marcellino Julian Gozal</h3> --}}
            <h3 class="name">{{ auth()->user()->name }}</h3>
            {{-- <h6 class="email">marveygoo88@gmail.com</h6> --}}
            <h6 class="email">{{ auth()->user()->email }}</h6>

        </div>
        <div class="profile-body">
            <form action="{{ route('submit_edit') }}" method="post" id="demo-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <div class="form-group ml-4 mt-4">
                    <label for="file-upload" class="inputLabel custom-file-upload">Change profile photo
                        <input type="file" name="profile_picture" id="file-upload" onchange="loadFile(event)">
                    </label>
                    @error('profile_picture')
                        <br>
                        <label for="profile_picture" class="inputLabel font-weight-bold">{{ $message }}</label>
                    @enderror

                    <br>
                    <label for="description" class="inputLabel">Description</label>
                    <textarea name="description" id="description" cols="30" maxlength="250" rows="4" class="form-control"
                        style="width:95%;">{{ auth()->user()->description }}</textarea>
                    @if (!auth()->user()->birthdate)
                        <label for="birthdate" class="inputLabel">Date of Birth</label><br>
                        <input type="date" class="inputBox" name="birthdate" id="birthdate">
                        @error('birthdate')
                            <br>
                            <label for="birthdate" class="inputLabel font-weight-bold">{{ $message }}</label>
                        @enderror
                        <br>
                        <label for="gender" class="inputLabel font-weight-bold">Gender</label> <br>
                        <input type="radio" name="gender" value="M" class="" style=" accent-color: #c28400;">
                        <div class="mr-3"
                            style="display: inline;
                                color:#c28400;
                                ">
                            Male</div>
                        <br>
                        <input type="radio" name="gender" value="F" class="" style=" accent-color: #c28400;">
                        <div
                            style="display:inline;
                                color:#c28400;
                                ">
                            Female</div>
                        @error('gender')
                            <br>
                            <label for="gender" class="inputLabel font-weight-bold">{{ $message }}</label>
                        @enderror
                        <br>
                    @endif
                    @if (!auth()->user()->password)
                        <label for="password" class="inputLabel font-weight-bold">Password</label>
                        <div>
                            <input type="password" name="password" id="password" placeholder="Type your password"
                                class="inputBox">
                            <i class="fa fa-eye-slash" id="see_password" aria-hidden="true" data-is_password=true></i>
                            @error('password')
                                <br>
                                <label for="password" class="inputLabel font-weight-bold">{{ $message }}</label>
                            @enderror
                        </div>
                        <label for="password_confirmation" class="inputLabel font-weight-bold pt-2">Confirm
                            Password</label>
                        <br>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Confirm your password" class="inputBox">
                        <i class="fa fa-eye-slash" id="see_password" aria-hidden="true" data-is_password=true></i>
                        @error('password_confirmation')
                            <br>
                            <label for="password_confirmation" class="inputLabel font-weight-bold">{{ $message }}</label>
                        @enderror
                        <br>
                    @endif
                    <button class="g-recaptcha change" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}"
                        data-callback='onSubmit'>Save</button>
                </div>
            </form>

            {{-- <button type="submit" class="change">Save</button> --}}

        </div>
    </div>
    {{-- <h2>This is the update profile page</h2> --}}


    <script>
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }

        var loadFile = function(event) {
            var image = document.getElementById("output");
            image.src = URL.createObjectURL(event.target.files[0]);
        };

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
    </script>

    <style>
        @media only screen and (max-width: 600px) {
            body {
                overflow-x: hidden;
                background-color: #ffcc5e;
            }

            .profile-card {
                margin-left: 10%;
                width: 80%;
            }

            .video-beach {
                width: 100vw;
            }
        }

        @media (min-width:641px) and (max-width:1000px) {
            body {
                background-color: #ffcc5e;
                font-size: 120%;
            }

            .video-beach {
                height: 100vh;
            }
        }
    </style>
@endsection
