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

                            {{ csrf_field() }}
                            <!-- Switch -->
                            <div class="wow fadeInLeft" id="backgroundSwitch">
                                <button id="switchInner1" onclick="switchLeaderboardRecent()" data-inner1=true>
                                    RECENT TRASH
                                </button>
                                <button id="switchInner2" onclick="switchLeaderboardMost()" data-inner2=false>
                                    MOST TRASH
                                </button>
                            </div>


                            <!-- Switch end -->
                            <br>
                            <!-- Search bar -->
                            <div style="display: flex; justify-content:center; align-items:center">
                                <div class="search mb-3  wow fadeInRight">
                                    <input type="text" placeholder="Search.." name="search" id="search">
                                    <button type="submit"><img src="/Images/search_icon.png" width="25px"
                                            alt=""></button>
                                </div>
                            </div>
                            <!-- Search bar end -->

                            <script>
                                // var _token = $('input[name="_token"]').val();
                                $(document).on('click', '#switchInner1', function() {
                                    $(this).data('inner1', true);
                                    $('#switchInner2').data('inner2', false);
                                    $('#search').val('');
                                    loadNames(0);
                                });
                                $(document).on('click', '#switchInner2', function() {
                                    $(this).data('inner2', true);
                                    $('#switchInner1').data('inner1', false);
                                    $('#search').val('');
                                    loadNames(1);
                                });

                                function checkSwitchInner1() {
                                    // alert($('#switchInner1').data('inner1'));
                                    return $('#switchInner1').data('inner1');
                                }

                                $(document).on('keyup', '#search', function() {
                                    // var points = $(this).data('points');
                                    var name = $(this).val();
                                    if (!(name == "")) {
                                        loadNames(0, name, 'true');
                                    } else {
                                        $('#result').html('');
                                        // loadNames(name, 0, _token);
                                        if (checkSwitchInner1()) {
                                            loadNames(0);
                                        } else {
                                            loadNames(1);
                                        }
                                        // loadNames("", _token);
                                    }
                                });

                                function loadNames(inner_one = 0, name = "", search_bar = 'false', _token = $('input[name="_token"]').val()) {
                                    $.ajax({
                                        url: "{{ route('loadmore.load_names') }}",
                                        method: 'POST',
                                        data: {
                                            inner_one: inner_one,
                                            name: name,
                                            search_bar: search_bar,
                                            _token: _token,
                                        },
                                        dataType: 'json',
                                        success: function(data) {
                                            $('#leaderboard-body').html(data.output);
                                        }
                                    });


                                }
                            </script>


                            <!-- Leaderboard Cards -->
                            <div style="display: flex; justify-content:center; align-items:center">
                                <div class="leaderboard-body " id="leaderboard-body">
                                    @php
                                        $left = true;
                                        $counter = 0;
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
                                                    @if ($a->anonymous)
                                                        <h3 id="nama-leaderboard">Anonymous</h3>
                                                    @else
                                                        <h3 id="nama-leaderboard">{{ $a->nickname }}</h3>
                                                    @endif
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
                                                    @if ($a->anonymous)
                                                        <h3 id="nama-leaderboard">Anonymous</h3>
                                                    @else
                                                        <h3 id="nama-leaderboard">{{ $a->nickname }}</h3>
                                                    @endif
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
                                        @php
                                            $counter += 1;
                                            if ($counter == 10) {
                                                break;
                                            }
                                        @endphp
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
