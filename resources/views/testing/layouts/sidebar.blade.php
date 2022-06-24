        {{-- <div class="bg-dark"> --}}
        <link rel="stylesheet" href="/stylesheets/sidebar.css">
        {{-- <script src="/Scripts/sidebar.js"></script> --}}
        {{-- <script></script> --}}
        <div>
            <!-- Sidebar -->
            <div id="mySidebar" class="sidebar">
                <div class="profile text-center">
                    @auth
                        @if (!auth()->user()->profile_picture)
                            @if (auth()->user()->avatar)
                                <a href="{{ route('profile_page_trial') }}"><img src="{{ auth()->user()->avatar }}"
                                        alt="" class="profile-photo" /></a>
                            @else
                                <a href="{{ route('profile_page_trial') }}"><img src="/profilePhotos/stock.png"
                                        alt="" class="profile-photo" /></a>
                            @endif
                        @else
                            <a href="{{ route('profile_page_trial') }}"><img
                                    src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt=""
                                    class="profile-photo" /></a>
                        @endif

                        {{-- <div class="photo-container">
                            <a href="{{ route('profile_page_trial') }}"><img src="/profilePhotos/stock.png" alt=""
                                    class="profile-photo" /></a>
                        </div> --}}
                        <h3 class="mt-3">{{ auth()->user()->name }}</h3>

                        <form action="/account/logout" method="post">
                            @csrf
                            <button type="submit"
                                class="btn btn-link nav-link me-2 text-decoration-none text-center text-secondary "
                                style="margin-left: 35%">Logout</button>
                        </form>
                    @endauth
                    @guest
                        <div class="ask-account">
                            <a href="{{ route('login_trial') }}" class="mt-3">Sign in</a>
                            <a href="{{ route('regist_trial') }}">Create Account</a>
                        </div>
                    @endguest
                </div>
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <!-- <hr class="mt-5"> -->
                @guest

                    <div class="bar" style="border-top: 0.8px solid rgba(90, 90, 90, 0.555)">
                        <a href="{{ route('init') }}" class="">
                            <img src="/Images/home.png" class="icon" width="50px" alt="" style="" />
                            <h3 class="text-bar">HOME</h3>
                        </a>
                    </div>
                    <!-- <hr> -->
                    <div class="bar">
                        <a href="{{ route('init') }}#donationCard" class="" id="donationCardLink">
                            <img src="/Images/donate.png" class="icon" width="50px" alt="" style="" />
                            <h3 class="text-bar">DONATE NOW</h3>
                        </a>
                    </div>
                    <!-- <hr> -->
                    <div class="bar">
                        <a href="{{ route('init') }}#leaderboard" class="">
                            <img src="/Images/leaderboard.png" class="icon" width="50px" alt=""
                                style="" />
                            <h3 class="text-bar">LEADERBOARD</h3>
                        </a>
                    </div>
                    <!-- <hr> -->
                    <div class="bar">
                        <a href="{{ route('init') }}#location-container" class="">
                            <img src="/Images/location.png" class="icon" width="50px" alt="" style="" />
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
            @endguest
            @auth
                <div class="bar" style="border-top: 0.8px solid rgba(90, 90, 90, 0.555)">
                    <a href="{{ route('home_page') }}" class="">
                        <img src="/Images/home.png" class="icon" width="50px" alt="" style="" />
                        <h3 class="text-bar">HOME</h3>
                    </a>
                </div>
                <!-- <hr> -->
                <div class="bar">
                    <a href="{{ route('home_page') }}#donationCard" class="" id="donationCardLink">
                        <img src="/Images/donate.png" class="icon" width="50px" alt="" style="" />
                        <h3 class="text-bar">DONATE NOW</h3>
                    </a>
                </div>
                <!-- <hr> -->
                <div class="bar">
                    <a href="{{ route('home_page') }}#leaderboard" class="">
                        <img src="/Images/leaderboard.png" class="icon" width="50px" alt="" style="" />
                        <h3 class="text-bar">LEADERBOARD</h3>
                    </a>
                </div>
                <!-- <hr> -->
                <div class="bar">
                    <a href="{{ route('home_page') }}#location-container" class="">
                        <img src="/Images/location.png" class="icon" width="50px" alt="" style="" />
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

        @endauth
        </div>
