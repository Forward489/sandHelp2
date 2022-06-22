{{-- @dd($donations) --}}
@php
    $total_donation = 0;
    foreach($donations as $a) {
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
    </body>
</div>

<!-- Javascripts -->
<script>
    //Animate Number Function
    function animateProgessNumber(obj, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const currencyFractionDigits = new Intl.NumberFormat('de-DE', {
                style: 'currency',
                currency: 'IDR',
            }).resolvedOptions().maximumFractionDigits;
            obj.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString('en-US', {
                maximumFractionDigits: currencyFractionDigits
            });
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    obj = document.getElementById("currentProgress");
    console.log(obj.getAttribute("data-value"))
    animateProgessNumber(obj, 0, Number(obj.getAttribute("data-value")), 2000)

    //Function Ganti background sesuai jam
    function changeBackground() {
        var now = new Date();
        hour = now.getHours();
        // hour = 15;
        // x = 1;
        if (hour >= 0 && hour <= 3) {
            document.querySelector('#player').setAttribute("src", "/Videos/background_beach_night.mp4");
        } else if (hour >= 4 && hour <= 7) {
            document.querySelector('#player').setAttribute("src", "/Videos/background_beach_dawn.mp4");
        } else if (hour >= 8 && hour <= 14) {
            document.querySelector('#player').setAttribute("src", "/Videos/background_beach_sunny.mp4");
        } else if (hour >= 15 && hour <= 17) {
            document.querySelector('#player').setAttribute("src", "/Videos/background_beach_dawn.mp4");
        } else if (hour >= 18 && hour <= 24) {
            document.querySelector('#player').setAttribute("src", "/Videos/background_beach_night.mp4");
        }
    }
    //changeBackground();


    // Set Kilograms choose
    var amount = null;
    var inputAmount = document.getElementById("amountDonation");
    var buttonBefore = null

    function setKg(btnChoose) {
        inputAmount.style.backgroundColor = "#fceee1";
        if (buttonBefore != null) {
            buttonBefore.style.backgroundColor = "#fceee1";
            buttonBefore.style.border = "0.5px solid #e9cea0";
            buttonBefore.style.color = "#e2ac4d"
        }
        buttonBefore = btnChoose;

        amount = btnChoose.getAttribute('data-value');
        btnChoose.style.backgroundColor = "#dcbe89";
        btnChoose.style.border = "0px solid black";
        btnChoose.style.color = "white";
        inputAmount.value = null;
    }

    //Reset warna button yang tidak dipilih
    function resetColorButtons() {
        buttonBefore.style.backgroundColor = "#fceee1";
        buttonBefore.style.border = "0.5px solid #e9cea0";
        buttonBefore.style.color = "#e2ac4d"
        inputAmount.style.border = "0.5px solid #e9cea0";
        inputAmount.style.backgroundColor = "#dcbe89";
        amount = null;
    }

    var buttonRecent = document.getElementById("switchInner1");
    var buttonMost = document.getElementById("switchInner2");

    //Switch functions
    function switchLeaderboardRecent() {

        buttonMost.style.boxShadow = "0px 0px";
        buttonMost.style.backgroundColor = "rgba(255, 255, 255, 0)";
        buttonRecent.style.boxShadow = "0px 0px 10px 5px rgba(0, 0, 0, 0.247)"
        buttonRecent.style.backgroundColor = "rgba(255, 255, 255, 1)";

    }

    function switchLeaderboardMost() {

        buttonRecent.style.boxShadow = "0px 0px";
        buttonRecent.style.backgroundColor = "rgba(255, 255, 255, 0)";
        buttonMost.style.boxShadow = "0px 0px 10px 5px rgba(0, 0, 0, 0.247)"
        buttonMost.style.backgroundColor = "rgba(255, 255, 255, 1)";

    }

    // includeHTML();

    //Ganti card
    $(document).ready(function() {
        $("#btnSubmit").click(function() {
            if (inputAmount.value != "") {
                amount = inputAmount.value;
            }
            if (amount != null) {
                $("#donationCard").hide();
                $("#donationCard2").show();
                document.getElementById("donationCardLink").href = "#donationCard2";
                document.getElementById("donation-card-link-footer").href = "#donationCard2";
                var jumlahBayar = parseInt(amount) * 5000;
                getDollar();
                $('.money_amount_rupiah').val(jumlahBayar);
                const currencyFractionDigits = new Intl.NumberFormat('de-DE', {
                    style: 'currency',
                    currency: 'IDR',
                }).resolvedOptions().maximumFractionDigits;
                document.getElementById("total").value = "Rp. " + jumlahBayar.toLocaleString('en-US', {
                    maximumFractionDigits: currencyFractionDigits
                }) + ".00 (" + amount + " kg)";
            } else {
                var errorInputTab = document.getElementById("errorInputKgTab");
                errorInputTab.innerHTML = "Masukkan input terlebih dahulu!";
            }

        });

        function getDollar() {
            const api = "https://api.exchangerate-api.com/v4/latest/USD";

            fetch(`${api}`).then(currency => {
                return currency.json()
            }).then(getDalla)
        }

        function getDalla(currency) {
            let resultFrom = 'IDR';
            let resultTo = 'USD';

            let fromRate = currency.rates[resultFrom];
            let toRate = currency.rates[resultTo];
            // let fromRate2 = currency.rates[resultFrom];
            // let toRate1 = currency.rates[resultTo];

            // console.log(fromRate);
            // console.log(toRate);

            var rupiah = parseInt(getTotalDonationRupiah());

            // alert('woohoo');

            var finalValue = ((toRate / fromRate) * rupiah).toFixed(2);

            // alert(finalValue);
            $('.money_amount_dollar').val(finalValue);
        }

        function getTotalDonationRupiah() {
            // alert(parseInt($('#test_payPal').val()));
            return $('.money_amount_rupiah').val();
        }
        $("#previousCard").click(function() {
            $("#donationCard2").hide();
            $("#donationCard").show();
            document.getElementById("donationCardLink").href = "#donationCard";
            document.getElementById("donation-card-link-footer").href = "#donationCard";
            inputAmount.value = "";
            buttonBefore.style.backgroundColor = "#fceee1";
            buttonBefore.style.border = "0.5px solid #e9cea0";
            buttonBefore.style.color = "#e2ac4d"
            amount = null;
            document.getElementById("errorInputKgTab").innerHTML = "";
        });
    });
</script>


<!-- Jquery -->
<script>
    //Sidebar function
    $(document).ready(function() {
        $(".container-full").click(function() {
            closeNav();
        });
    });
</script>


<!-- MAPS -->
<script src='https://maps.googleapis.com/maps/api/js?key=&libraries=visualization'></script>
<script>
    function init() {
        var mapOptions = {
            "center": {
                "lat": -2.148019797875217,
                "lng": 115.92865308125003
            },
            "clickableIcons": false,
            "disableDoubleClickZoom": true,
            "draggable": true,
            "fullscreenControl": false,
            "keyboardShortcuts": false,
            "mapTypeControl": false,
            "mapTypeControlOptions": {
                "text": "Default (depends on viewport size etc.)",
                "style": 0
            },
            "mapTypeId": "roadmap",
            "rotateControl": true,
            "scaleControl": false,
            "scrollwheel": false,
            "streetViewControl": false,
            "styles": [{
                "elementType": "labels.text",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "landscape.natural",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#f5f5f2"
                }, {
                    "visibility": "on"
                }]
            }, {
                "featureType": "administrative",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "transit",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.attraction",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "landscape.man_made",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "visibility": "on"
                }]
            }, {
                "featureType": "poi.business",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.medical",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.place_of_worship",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.school",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi.sports_complex",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "visibility": "simplified"
                }]
            }, {
                "featureType": "road.arterial",
                "stylers": [{
                    "visibility": "simplified"
                }, {
                    "color": "#ffffff"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.icon",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.arterial",
                "stylers": [{
                    "color": "#ffffff"
                }]
            }, {
                "featureType": "road.local",
                "stylers": [{
                    "color": "#ffffff"
                }]
            }, {
                "featureType": "poi.park",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "poi",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "water",
                "stylers": [{
                    "color": "#71c8d4"
                }]
            }, {
                "featureType": "landscape",
                "stylers": [{
                    "color": "#e5e8e7"
                }]
            }, {
                "featureType": "poi.park",
                "stylers": [{
                    "color": "#8ba129"
                }]
            }, {
                "featureType": "road",
                "stylers": [{
                    "color": "#ffffff"
                }]
            }, {
                "featureType": "poi.sports_complex",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#c7c7c7"
                }, {
                    "visibility": "off"
                }]
            }, {
                "featureType": "water",
                "stylers": [{
                    "color": "#a0d3d3"
                }]
            }, {
                "featureType": "poi.park",
                "stylers": [{
                    "color": "#91b65d"
                }]
            }, {
                "featureType": "poi.park",
                "stylers": [{
                    "gamma": 1.51
                }]
            }, {
                "featureType": "road.local",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "poi.government",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "landscape",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "simplified"
                }]
            }, {
                "featureType": "road.local",
                "stylers": [{
                    "visibility": "simplified"
                }]
            }, {
                "featureType": "road"
            }, {
                "featureType": "road"
            }, {}, {
                "featureType": "road.highway"
            }],
            "zoom": 5,
            "zoomControl": true
        };
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker0 = new google.maps.Marker({
            title: "Pantai Cipta",
            icon: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png",
            position: new google.maps.LatLng(-6.9494469, 110.4103404),
            map: map
        });
        var infowindow0 = new google.maps.InfoWindow({
            content: "<h3 class=\"infoTitle\">Pantai Cipta</h3><p></p>",
            map: map
        });
        marker0.addListener('click', function() {
            infowindow0.open(map, marker0);
        });
        infowindow0.close();
        var marker1 = new google.maps.Marker({
            title: "Pantai Labuhan Haji",
            icon: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png",
            position: new google.maps.LatLng(-8.663175599999999, 116.5586289),
            map: map
        });
        var infowindow1 = new google.maps.InfoWindow({
            content: "<h3 class=\"infoTitle\">Pantai Labuhan Haji</h3><p></p>",
            map: map
        });
        marker1.addListener('click', function() {
            infowindow1.open(map, marker1);
        });
        infowindow1.close();
        var marker2 = new google.maps.Marker({
            title: "Pantai Muaro Lasak",
            icon: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png",
            position: new google.maps.LatLng(-0.9292253, 100.3500398),
            map: map
        });
        var infowindow2 = new google.maps.InfoWindow({
            content: "<h3 class=\"infoTitle\">Pantai Muaro Lasak</h3><p></p>",
            map: map
        });
        marker2.addListener('click', function() {
            infowindow2.open(map, marker2);
        });
        infowindow2.close();
        var marker3 = new google.maps.Marker({
            title: "Pantai Pangandaran",
            icon: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png",
            position: new google.maps.LatLng(-7.687553500000001, 108.6387427),
            map: map
        });
        var infowindow3 = new google.maps.InfoWindow({
            content: "<h3 class=\"infoTitle\">Pantai Pangandaran</h3><p></p>",
            map: map
        });
        marker3.addListener('click', function() {
            infowindow3.open(map, marker3);
        });
        infowindow3.close();
        var marker4 = new google.maps.Marker({
            title: "Pantai Maratua",
            icon: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png",
            position: new google.maps.LatLng(2.2327288, 118.5768801),
            map: map
        });
        var infowindow4 = new google.maps.InfoWindow({
            content: "<h3 class=\"infoTitle\">Pantai Maratua</h3><p></p>",
            map: map
        });
        marker4.addListener('click', function() {
            infowindow4.open(map, marker4);
        });
        infowindow4.close();
        var marker5 = new google.maps.Marker({
            title: "Pantai Kuta",
            icon: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png",
            position: new google.maps.LatLng(-8.7184926, 115.1686322),
            map: map
        });
        var infowindow5 = new google.maps.InfoWindow({
            content: "<h3 class=\"infoTitle\">Pantai Kuta</h3><p></p>",
            map: map
        });
        marker5.addListener('click', function() {
            infowindow5.open(map, marker5);
        });
        infowindow5.close();
        var marker6 = new google.maps.Marker({
            title: "Pantai Batakan",
            icon: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png",
            position: new google.maps.LatLng(-4.0966441, 114.6305531),
            map: map
        });
        var infowindow6 = new google.maps.InfoWindow({
            content: "<h3 class=\"infoTitle\">Pantai Batakan</h3><p></p>",
            map: map
        });
        marker6.addListener('click', function() {
            infowindow6.open(map, marker6);
        });
        infowindow6.close();
        var marker7 = new google.maps.Marker({
            title: "Pantai Hamadi Jayapura",
            icon: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png",
            position: new google.maps.LatLng(-2.5788312, 140.7091912),
            map: map
        });
        var infowindow7 = new google.maps.InfoWindow({
            content: "<h3 class=\"infoTitle\">Pantai Hamadi Jayapura</h3><p></p>",
            map: map
        });
        marker7.addListener('click', function() {
            infowindow7.open(map, marker7);
        });
        infowindow7.close();
        var marker8 = new google.maps.Marker({
            title: "Pantai Losari",
            icon: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png",
            position: new google.maps.LatLng(-5.1436198, 119.4074821),
            map: map
        });
        var infowindow8 = new google.maps.InfoWindow({
            content: "<h3 class=\"infoTitle\">Pantai Losari</h3><p></p>",
            map: map
        });
        marker8.addListener('click', function() {
            infowindow8.open(map, marker8);
        });
        infowindow8.close();
        var marker9 = new google.maps.Marker({
            title: "Pantai Marunda",
            icon: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png",
            position: new google.maps.LatLng(-6.0926996, 106.9615049),
            map: map
        });
        var infowindow9 = new google.maps.InfoWindow({
            content: "<h3 class=\"infoTitle\">Pantai Marunda</h3><p></p>",
            map: map
        });
        marker9.addListener('click', function() {
            infowindow9.open(map, marker9);
        });
        infowindow9.close();
        var marker10 = new google.maps.Marker({
            title: "Pantai Pagatan",
            icon: "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png",
            position: new google.maps.LatLng(-3.616241, 115.9001586),
            map: map
        });
        var infowindow10 = new google.maps.InfoWindow({
            content: "<h3 class=\"infoTitle\">Pantai Pagatan</h3><p></p>",
            map: map
        });
        marker10.addListener('click', function() {
            infowindow10.open(map, marker10);
        });
        infowindow10.close();
        var heatmap = new google.maps.visualization.HeatmapLayer({
            data: []
        });
        heatmap.setOptions({
            "dissipating": false,
            "opacity": 0.6,
            "radius": 2
        });
        heatmap.setMap(map);
        google.maps.event.addDomListener(window, "resize", function() {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
    }
    google.maps.event.addDomListener(window, 'load', init);
</script>
<!-- MAPS END -->






</html>
