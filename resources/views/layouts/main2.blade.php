<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />


    <link rel="stylesheet" href="/stylesheets/accountHandling.css">
    {{-- <link rel="stylesheet" href="/stylesheets/accountHandling.css"> --}}
    <link rel="icon" type="image/png" href="/Images/favicon.png">

    {{-- <script src="/Scripts/includeHtml.js"></script> --}}
    <script src="/Scripts/changeBackground.js"></script>
    <script src="/Scripts/showPopup.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <title>{{ $title }}</title>
</head>

<div style="overflow-x:hidden">

    {{-- <body class="" style="" onload="changeBackground('no_logo'),includeHTML();"> --}}

    <body class="" style="" onload="changeBackground('no_logo')">
        {{-- popup --}}
        {{-- @include('layouts.popup') --}}
        {{-- <div w3-include-html="/htmls/popup.html"></div> --}}
        <div class="video-container">
            <!-- Video Background -->
            <video autoplay muted loop class="video_beach" id="player">
                <source id="beach_video_background" src="" type="video/mp4" />
            </video>
            <!-- Video Background End -->

            <div class="layer">

            </div>

            <div class="row text-center login-card " style="">
                <div class="col-md-4" id="mobile-ruiner">

                </div>

                <div class="col-md-4 text-center" id="form_input">
                    <div>
                        <a href="index.html"><img src="/Images/banner_form.png" width="100%" class="banner"
                                alt=""></a>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>


    </body>
</div>


</html>
