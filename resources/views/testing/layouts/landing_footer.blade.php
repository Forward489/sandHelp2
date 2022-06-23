            <!-- Footer -->
            <!-- Footer -->
            <link rel="stylesheet" href="/stylesheets/footer.css">
            <div class="container-fluid text-center footer">
                <!-- Social Media Links -->
                <a href="https://www.facebook.com" class=""><i class="fa fa-facebook-square"
                        aria-hidden="true"></i></a>
                <a href="https://www.instagram.com" class=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="https://www.twitter.com" class=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="https://www.youtube.com" class=""><i class="fa fa-youtube" aria-hidden="true"></i></a>
                <!-- Social Media Links End -->
                <br>
                <!-- Bottom link container -->
                <div class="row link-container">

                    @guest

                        <!-- Left -->
                        <div class="col-md-3">
                            <div class="page-links text-left">
                                <a href="{{ route('init') }}" class="link link-left">HOME</a>
                                <a href="{{ route('init') }}#donationCard" class="link link-left"
                                    id="donation-card-link-footer">DONATE</a>
                            </div>
                        </div>
                        <!-- Left end -->

                        <!-- Middle -->
                        <div class="col-md-6">
                            <h1 class="hashtag">#SANDHELP</h1>
                        </div>
                        <!-- Middle end -->

                        <!-- Right -->
                        <div class="col-md-3 text-right">
                            <a href="{{ route('init') }}#leaderboard" class="link link-right">LEADERBOARD</a>
                            <a href="{{ route('init') }}#location-container" class="link link-right">LOCATIONS</a>
                        </div>
                    </div>
                    <!-- Right end -->
                @endguest

                @auth
                    <!-- Left -->
                    <div class="col-md-3">
                        <div class="page-links text-left">
                            <a href="{{ route('home_page') }}" class="link link-left">HOME</a>
                            <a href="{{ route('home_page') }}#donationCard" class="link link-left"
                                id="donation-card-link-footer">DONATE</a>
                        </div>
                    </div>
                    <!-- Left end -->

                    <!-- Middle -->
                    <div class="col-md-6">
                        <h1 class="hashtag">#SANDHELP</h1>
                    </div>
                    <!-- Middle end -->

                    <!-- Right -->
                    <div class="col-md-3 text-right">
                        <a href="{{ route('home_page') }}#leaderboard" class="link link-right">LEADERBOARD</a>
                        <a href="{{ route('home_page') }}#location-container" class="link link-right">LOCATIONS</a>
                    </div>
                </div>
                <!-- Right end -->

            @endauth
            </div>
            <!-- Bottom link container end -->
            </div>
            <!-- Footer End  -->
            <!-- Footer end -->
