        {{-- <div class="bg-dark"> --}}
        <div>
            <!-- Sidebar -->
            <div id="mySidebar" class="sidebar">
                <div class="profile text-center">
                    <div class="photo-container">
                        <a href="profilePage.html"
                            ><img
                                src="/profilePhotos/stock.png"
                                alt=""
                                class="profile-photo"
                        /></a>
                    </div>
                    <div class="ask-account">
                        <a href="{{ route('login_trial') }}" class="mt-3">Sign in</a>
                        <a href="{{ route('regist_trial') }}">Create Account</a>
                    </div>
                </div>
                <a
                    href="javascript:void(0)"
                    class="closebtn"
                    onclick="closeNav()"
                    >&times;</a
                >
                <!-- <hr class="mt-5"> -->
                <div
                    class="bar"
                    style="border-top: 0.8px solid rgba(90, 90, 90, 0.555)"
                >
                    <a href="/homePage" class="">
                        <img
                            src="/Images/home.png"
                            class="icon"
                            width="50px"
                            alt=""
                            style=""
                        />
                        <h3 class="text-bar">HOME</h3>
                    </a>
                </div>
                <!-- <hr> -->
                <div class="bar">
                    <a href="#donationCard" class="" id="donationCardLink">
                        <img
                            src="/Images/donate.png"
                            class="icon"
                            width="50px"
                            alt=""
                            style=""
                        />
                        <h3 class="text-bar">DONATE NOW</h3>
                    </a>
                </div>
                <!-- <hr> -->
                <div class="bar">
                    <a href="#leaderboard" class="">
                        <img
                            src="/Images/leaderboard.png"
                            class="icon"
                            width="50px"
                            alt=""
                            style=""
                        />
                        <h3 class="text-bar">LEADERBOARD</h3>
                    </a>
                </div>
                <!-- <hr> -->
                <div class="bar">
                    <a href="#location-container" class="">
                        <img
                            src="/Images/location.png"
                            class="icon"
                            width="50px"
                            alt=""
                            style=""
                        />
                        <h3 class="text-bar">PROJECT LOCATIONS</h3>
                    </a>
                </div>

                <!-- <hr> -->
            </div>

            <!-- Sidebar End -->

            <!-- Navbar Button -->
            <div id="main" class="mr-auto">
                <button class="openbtn" id="openBtn" onclick="openNav()">
                    ☰
                </button>
            </div>
            <!-- Navbar Button End -->
        </div>