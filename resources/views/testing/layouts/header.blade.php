        <link rel="stylesheet" href="/stylesheets/header.css">

        @guest
            <div class="header">
                <a href="{{ route('init') }}"><img src="/Images/logo.png" class="logo mt-4 mb-4" alt=""></a>
            </div>
        @endguest

        @auth
            <div class="header">
                <a href="{{ route('home_page') }}"><img src="/Images/logo.png" class="logo mt-4 mb-4" alt=""></a>
            </div>
        @endauth
