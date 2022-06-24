@extends('testing.layouts.main_account')


@section('container')
    <h3 class="welcome pb-1">
        Verify your Email Address
    </h3>

    <img src="/Images/verify_email.png" width="280px" alt="" class="pt-3 pb-3">
    <br>
    <p>
        <b>Woohoo!</b> Congratulations on becoming a new sand warrior. <br>
    <div id="email" class="font-weight-bold" style="font-size: larger;" name="email">{{ $email }}</div> <br>
    Verify your email address by clicking the button below !
    </p>

    {{-- <button type="button" class="verify mb-5">
        Become a Certified <br> Sand Warrior
    </button> --}}

    <form action="{{ route('emailVerControl') }}" method="post" id="demo-form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <button type="button" class="g-recaptcha verify mb-5" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITEKEY') }}"
            data-callback='onSubmit'>
            Become a Certified <br> Sand Warrior
        </button>

        {{-- <button type="submit" class="btn btn-primary">Verify E-mail</button> --}}
    </form>




    <script>
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
    </script>


@endsection

{{-- @section('footer')
    <link rel="stylesheet" href="/stylesheets/footer.css">
    @include('testing.layouts.landing_footer')
@endsection --}}
