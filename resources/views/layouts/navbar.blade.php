<nav class="navbar navbar-expand-lg navbar-light bg-light" id="main_navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- {{-- <li class="nav-item">
            <a class="nav-link {{ $active === 'home' ? "active" : "" }}" aria-current="page" href="/">Home</a>
          </li> --}} -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == '' ? 'active' : '' }}" aria-current="page"
                        href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'testing' ? 'active' : '' }}"
                        href="/testing">Testing</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'payPal' ? 'active' : '' }}"
                        href="/payPal">PayPal Test</a>
                </li>
                @endauth
                <!-- {{-- <li class="nav-item">
            <a class="nav-link {{ $active === 'details' ? "active" : "" }}" href="/details">Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $active === 'mapping' ? "active" : "" }}" href="/mapping">Mapping</a>
          </li> --}}
                {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li> --}} -->
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item d-flex">
                        <div class="nav-link me-2 text-decoration-none">
                            Welcome back, {{ auth()->user()->name }}
                        </div>
                    </li>
                    <li class="nav-item d-flex">
                        <a class="nav-link me-2 text-decoration-none" href="{{ route('edit_profile') }}">Edit Profile</a>
                    </li>
                    <li class="nav-item d-flex">
                        <form action="/account/logout" method="post">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link me-2 text-decoration-none">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item d-flex">
                        <a class="nav-link me-2 text-decoration-none" href="/account/login">Login</a>
                    </li>
                @endauth
            </ul>

            <!-- {{-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> --}} -->
        </div>
    </div>
</nav>
