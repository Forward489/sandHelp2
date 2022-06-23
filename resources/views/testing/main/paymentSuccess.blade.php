@auth
    @extends('testing.layouts.transaction')

    @section('container')
        <div class="card-container text-center">
            <img src="/Images/transaction_success.png" class="icon" alt="">
            <h4 class="title mt-5">
                Your donation has been sent! <br>
                See your donation in the leaderboard !
            </h4>

            <a href="{{ route('home_page') }}#leaderboard"><button type="button"
                    class="button-redirect">Leaderboard</button></a>
        </div>
    @endsection
@endauth
