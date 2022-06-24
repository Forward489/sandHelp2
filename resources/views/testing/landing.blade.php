{{-- @dd($donations) --}}
@php
$total_donation = 0;
foreach ($donations as $a) {
    $total_donation += $a->money_amount;
}
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    @include('testing.layouts.assets')

    <title>SAND HELP</title>
</head>

<div style="overflow-x:hidden;">

    <body onload="changeBackground('logo')">
        @include('testing.layouts.preloader')

        <!-- Sidebar -->
        {{-- <div w3-include-html="/htmls/sidebar.html"></div> --}}
        @include('testing.layouts.sidebar')
        <!-- Sidebar end -->


        <div class="container-full">
            <!-- Background Beach Container -->
            <div id="background-beach-container" class="container-fluid wow fadeIn">

                <!-- Video Background -->
                <video autoplay muted loop class="video_beach" id="player">
                    <source id="beach_video_background" src="" type="video/mp4" />
                </video>
                <!-- Video Background End -->

                <!-- Total Donation Text -->
                <h3 class="text-center text-white" id="totalDonation">
                    DONATION RAISED <br>
                </h3>


                <h1 class="count text-center text-white" data-value={{ $total_donation }} id="currentProgress">0</h1>
                {{-- <h1 class="count text-center text-white" data-value=2000000000 id="currentProgress">0</h1> --}}
                <!-- Total Donation Text End -->

            </div>
            <!-- Background Beach Container End -->

            <!-- Container donasi & Leaderboard -->
            <div class="container-fluid bg-dark" id="areaDonasi">
                <div class="row">
                    <!-- Left column -->
                    <div class="col-md-4 col-sm-4">

                    </div>
                    <!-- Left column end -->

                    <!-- Middle column -->
                    <div class="col-md-4 col-sm-4 wow fadeInDown">
                        @include('testing.feature.form_donation')
                        <!-- Card bagian 2 end -->
                    </div>
                    <!-- Middle Column End -->

                    <!-- Left column -->
                    <div class="col-md-4 col-sm-4">

                    </div>
                    <!-- Left column end -->
                </div>

                {{-- @dd($donations) --}}
                @include('testing.feature.leaderboard')
            </div>
            <!-- Container donasi & Leaderboard end -->

            <!-- Separator -->
            <div class="" style="z-index: -3;height:10vh;background:#ffffff">

                <div class="separator text-left">

                </div>

            </div>
            <!-- Separator end -->

            <!-- Project locations -->
            <div class="container-fluid location-container text-center" id="location-container">
                <img src="/Images/PROJECT LOCATION.png" class="wow zoomIn project-location-title">
                <div class="map-container">
                    <div class="wow zoomIn" id='map'></div>
                </div>

            </div>
            <!-- Project locations end -->

            @include('testing.layouts.landing_footer')
        </div>
        
            
            {{-- <div class="pepal"> --}}
            {{-- </div> --}}
    </body>
</div>
<script src="/Scripts/indexScript.js"></script>
<script src='https://maps.googleapis.com/maps/api/js?key=&libraries=visualization'></script>
<script src="/Scripts/googleMaps.js"></script>

</html>
