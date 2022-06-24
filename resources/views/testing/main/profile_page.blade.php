@extends('testing.main.profile_template')

@section('container')
    <div class="profile-card">
        <div class="profile-header text-center">
            <div style="border-bottom: 2px solid #c28400;">
                <a href="{{ route('home_page') }}"><img src="/Images/logo.png" alt="" class="logo"></a>
            </div>

            <div class="settings-wrapper text-right">
                <a href="{{ route('change_page_trial') }}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            </div>

            @if (auth()->user()->profile_picture)
                <a href="{{ route('change_page_trial') }}">
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt=""
                        class="profile-photo">
                </a>
            @else
                <a href="{{ route('change_page_trial') }}">
                    <img src="/profilePhotos/stock.png" alt="" class="profile-photo">
                </a>
            @endif
            {{-- <img src="/profilePhotos/stock.png" alt="" class="profile-photo"> --}}

            {{-- <h3 class="name">Marcellino Julian Gozal</h3>
            <h6 class="email">marveygoo88@gmail.com</h6> --}}
            <h3 class="name" style="color:#c28400">{{ auth()->user()->name }}</h3>
            <h6 class="email" style="color:#c28400">{{ auth()->user()->email }}</h6>

        </div>
        <div class="profile-body">
            <div class="points font-weight-bold text-center pb-2" style="color:#c28400">
                @if (auth()->user()->points >= 0 && auth()->user()->points < 1000)
                    <img src="/Images/TIER 3.png" class="pb-2" width="50px" alt="">
                @elseif(auth()->user()->points > 1000 && auth()->user()->points < 50000)
                    <img src="/Images/TIER 2.png" class="pb-2" width="50px" alt="">
                @else
                    <img src="/Images/TIER 1.png" class="pb-2" width="50px" alt="">
                @endif
                {{-- <img src="/Images/TIER 1.png" class="pb-2" width="50px" alt=""> --}}

                <div style="display: inline-block; margin-left:2px;">{{ number_format(auth()->user()->points) }} points
                </div>
                {{-- @php
                    $total_money_donate = (auth()->user()->points / 100) * 5000;
                    
                    $total_money_donate = number_format($total_money_donate);
                @endphp --}}
                <br>
                {{-- <div style="display: inline-block; margin-left:2px;">Rp. {{ $total_money_donate }}</div> --}}
            </div>

            <!-- <hr> -->
            <div class="information pl-3 pb-3 pt-3" style="color: #c19537">
                <h3 class="text-left font-weight-bold" style="color:#c28400">About me</h3>
                <div style="font-style:italic;">
                    @if (auth()->user()->description)
                        <h5>{{ auth()->user()->description }}</h5>
                    @else
                        <h5>No description set.</h5>
                    @endif
                </div>
                <h5 class="font-weight-bold mt-3">Birthday</h5>
                <div>
                    @if (auth()->user()->birthdate)
                        <h5>{{ auth()->user()->birthdate }}
                            <h5 class="font-weight-bold mt-3">Age</h5>
                            {{ \Carbon\Carbon::parse(auth()->user()->birthdate)->age }}
                            years old
                        </h5>
                    @else
                        <h5>You have to set your birthdate first</h5>
                    @endif
                </div>
                <h5 class="font-weight-bold mt-3">Gender</h5>
                <div>
                    @if (auth()->user()->gender == 'M')
                        <h5>Male</h5>
                    @elseif(auth()->user()->gender == 'F')
                        <h5>Female</h5>
                    @else
                        <h5>You need to set your gender first</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
