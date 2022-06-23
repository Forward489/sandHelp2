@extends('testing.layouts.transaction')


@section('container')
    <div class="card-container text-center">
        <img src="/Images/transaction_failed.png" class="icon" alt="">
        <h4 class="title mt-5">
            Sadly, your donation failed <br>
            Go back to homepage
        </h4>

        <a href="{{ route('init') }}#donationCard"><button type="button" class="button-redirect">Home</button></a>
    </div>
@endsection
