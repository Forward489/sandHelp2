                <!-- Leaderboard-->
                <div class="container-fluid pb-5" id="leaderboard">
                    <div class="row">
                        <div class="col-md-3 col-sm-2">

                        </div>

                        <!-- Leaderboard col -->
                        <div class="col-md-6 col-sm-8 mx-auto text-center pt-5 mt-5">
                            <!-- Leaderboard image -->
                            <div class="wow fadeInDown">
                                <img src="/Images/leaderboard_title.png" width="100%" class="leaderboard-image"
                                    style="transform: scale(1.0);" alt="">
                            </div>
                            <!-- Leaderboard image end -->

                            <!-- Switch -->
                            <div class=" wow fadeInLeft" id="backgroundSwitch">
                                <button id="switchInner1" onclick="switchLeaderboardRecent()">
                                    RECENT TRASH
                                </button>
                                <button id="switchInner2" onclick="switchLeaderboardMost()">
                                    MOST TRASH
                                </button>
                            </div>
                            <!-- Switch end -->
                            <br>
                            <!-- Search bar -->
                            <div style="display: flex; justify-content:center; align-items:center">
                                <div class="search mb-3  wow fadeInRight">
                                    <input type="text" placeholder="Search.." name="search">
                                    <button type="submit"><img src="/Images/search_icon.png" width="25px"
                                            alt=""></button>
                                </div>
                            </div>
                            <!-- Search bar end -->


                            <!-- Leaderboard Cards -->
                            <div style="display: flex; justify-content:center; align-items:center">
                                <div class="leaderboard-body " id="leaderboard-body">
                                    @php
                                        $left = true;
                                    @endphp
                                    @foreach ($donations as $a)
                                        <!-- Card 1 -->
                                        @if ($left)
                                            <div class="container-leaderboard mt-4 bg-light text-left wow fadeInLeft">
                                                @if ($a->trash_weights > 0 && $a->trash_weights < 100)
                                                    <img src="/Images/TIER 3.png" alt="" id="badge">
                                                @elseif($a->trash_weights > 100 && $a->trash_weights < 500)
                                                    <img src="/Images/TIER 2.png" alt="" id="badge">
                                                @else
                                                    <img src="/Images/TIER 1.png" alt="" id="badge">
                                                @endif
                                                {{-- <img src="/Images/TIER 3.png" alt="" id="badge"> --}}
                                                <div class="block-text-leaderboard" style="">
                                                    <h3 id="nama-leaderboard">{{ $a->nickname }}</h3>
                                                    {{-- <h5 id="pesan-leaderboard">message
                                                        </h5> --}}
                                                    <h5 id="pesan-leaderboard">{{ $a->message }}
                                                    </h5>
                                                </div>
                                                <div class="block-text-right-leaderboard">
                                                    <h3 class="leaderboard-amount">
                                                        <div id="leaderboard-amount" class="text-center">
                                                            {{ $a->trash_weights }} kg
                                                        </div>
                                                    </h3>
                                                </div>
                                            </div>
                                            <!-- Card 1 end -->
                                            @php
                                                $left = false;
                                            @endphp
                                        @else
                                            <div class="container-leaderboard mt-4 bg-light text-left wow fadeInRight">
                                                @if ($a->trash_weights > 0 && $a->trash_weights < 100)
                                                    <img src="/Images/TIER 3.png" alt="" id="badge">
                                                @elseif($a->trash_weights > 100 && $a->trash_weights < 500)
                                                    <img src="/Images/TIER 2.png" alt="" id="badge">
                                                @else
                                                    <img src="/Images/TIER 1.png" alt="" id="badge">
                                                @endif
                                                {{-- <img src="/Images/TIER 3.png" alt="" id="badge"> --}}
                                                <div class="block-text-leaderboard" style="">
                                                    <h3 id="nama-leaderboard">{{ $a->nickname }}</h3>
                                                    {{-- <h5 id="pesan-leaderboard">message
                                                        </h5> --}}
                                                    <h5 id="pesan-leaderboard">{{ $a->message }}
                                                    </h5>
                                                </div>
                                                <div class="block-text-right-leaderboard">
                                                    <h3 class="leaderboard-amount">
                                                        <div id="leaderboard-amount" class="text-center">
                                                            {{ $a->trash_weights }} kg
                                                        </div>
                                                    </h3>
                                                </div>
                                            </div>
                                            <!-- Card 1 end -->
                                            @php
                                                $left = true;
                                            @endphp
                                        @endif
                                    @endforeach


                                    {{-- <!-- Card 2 -->
                                    <div class="container-leaderboard mt-4 bg-light text-left wow fadeInRight">
                                        <img src="/Images/TIER 2.png" alt="" id="badge">
                                        <div class="block-text-leaderboard" style="">
                                            <h3 id="nama-leaderboard">Glenn Steven Santoso</h5>
                                                <h5 id="pesan-leaderboard">Long live Indonesia's Beach !</h6>
                                        </div>
                                        <div class="block-text-right-leaderboard">
                                            <h3 class="leaderboard-amount">
                                                <div id="leaderboard-amount" class="text-center">
                                                    10 kg
                                                </div>
                                            </h3>
                                        </div>
                                    </div>

                                    <!-- Card 2 end -->

                                    <!-- Card 3 -->
                                    <div class="container-leaderboard mt-4 bg-light text-left wow fadeInLeft">
                                        <img src="/Images/TIER 1.png" alt="" id="badge">
                                        <div class="block-text-leaderboard" style="">
                                            <h3 id="nama-leaderboard">Yefta Nathaniel Watson</h5>
                                                <h5 id="pesan-leaderboard">
                                                    </h6>
                                        </div>
                                        <div class="block-text-right-leaderboard">
                                            <h3 class="leaderboard-amount">
                                                <div id="leaderboard-amount" class="text-center">
                                                    100 kg
                                                </div>
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- Card 3 end --> --}}
                                </div>
                            </div>
                            <!-- Leaderboard Cards End -->
                        </div>
                        <!-- Leaderboard col end-->
                        <div class="col-md-3 col-sm-2">

                        </div>
                    </div>
                </div>
                <!-- Leaderboard End -->
