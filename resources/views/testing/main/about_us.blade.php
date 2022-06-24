<!DOCTYPE html>
<html lang="en">

<head>
    @include('testing.layouts.assets')
    <link rel="stylesheet" href="/stylesheets/aboutUs.css">
    <title>{{ $title }}</title>
</head>
<div style="overflow-x: hidden;">

    <body class="wow">
        <!-- Sidebar -->
        {{-- <div w3-include-html="/htmls/sidebar.html"></div> --}}
        @include('testing.layouts.sidebar')
        <!-- Sidebar end -->

        <div class="container-upper">
            <div class="left">
                <img src="/Images/about-us-upper.png" class="upper-image" alt="">
            </div>

            <div class="right">
                <h1 class="title">About us</h1>
                <h3 class="title-body mt-3">Sand Help is a new fundraising team that work on restoring the beauty of Indonesia'
                    s beaches. Our main mission is to gather people that wants to help restoring the beach just by donating some funds.
                    The gathered funds will be distributed to our special team on the field to clean beaches all over Indonesia
                </h3>
            </div>
        </div>

        @include('testing.layouts.landing_footer')
        {{-- <div w3-include-html="/htmls/footer.html"></div> --}}
    </body>
</div style="overflow-x:hidden">
</html>