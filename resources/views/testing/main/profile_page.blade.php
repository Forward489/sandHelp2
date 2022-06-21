@extends('testing.main.profile_template')

@section('container')
    <div class="profile-card">
        <div class="profile-header text-center">
            <div style="border-bottom: 2px solid #c28400;">
                <a href="{{ route('landing_testing') }}"><img src="/Images/logo.png" alt="" class="logo"></a>
            </div>

            <div class="settings-wrapper text-right">
                <a href="{{ route('change_page_trial') }}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            </div>

            <img src="/profilePhotos/stock.png" alt="" class="profile-photo">

            <h3 class="name">Marcellino Julian Gozal</h3>
            <h6 class="email">marveygoo88@gmail.com</h6>

        </div>
        <div class="profile-body">
            <div class="points font-weight-bold text-center pb-2">
                <img src="/Images/TIER 1.png" class="pb-2" width="50px" alt="">
                <div style="display: inline-block; margin-left:2px;">500 points</div>

            </div>

            <!-- <hr> -->
            <div class="information pl-3 pb-3 pt-3">
                <h3 class="text-left font-weight-bold">Personal Information</h3>
                <h5>About me</h5>
                <div></div>
                <h5>Birth Date</h5>
                <div></div>
                <h5>Gender</h5>
                <div></div>
            </div>
        </div>
    </div>

    
@endsection
