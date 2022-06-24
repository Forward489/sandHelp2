<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="icon" type="image/png" href="/Images/favicon.png">

    <link rel="stylesheet" href="/stylesheets/index.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.3.0/animate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js">

    <script src="/node_modules/wowjs/dist/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>

    <script src="/Scripts/preloader.js"></script>
    <script src="/Scripts/includeHtml.js"></script>
     --}}

    @include('testing.layouts.assets')

    <link rel="stylesheet" href="/stylesheets/profilePage.css">
    <script src="/Scripts/changeBackground.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    

    <title>{{ $title }}</title>
</head>

<div style="overflow-x: hidden;" class="wow fadeIn">

    <body onload="changeBackground('no_logo');">
        {{-- @include('testing.layouts.sidebar') --}}
        <!-- <div w3-include-html="/htmls/preloader.html"></div> -->
        <!-- <div w3-include-html="/htmls/header.html"></div> -->
        {{-- @include('testing.layouts.header') --}}
        <div class="layer"></div>
        <div class="video-container">
            <!-- Video Background -->
            <video autoplay muted loop class="video_beach" id="player">
                <source id="beach_video_background" src="" type="video/mp4" />
            </video>
            <!-- Video Background End -->
        </div>

        @yield('container')

        @include('testing.layouts.landing_footer')

        {{-- <div w3-include-html="/htmls/footer.html" class="footer"></div> --}}
    </body>
</div>

</html>