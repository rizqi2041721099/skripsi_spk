    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>SPK Tempat Makan</h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
                <a href="/" class="nav-item nav-link {{ Route::is('landing-page') ? 'active' : '' }}">Home</a>
                <a href="#about-us" class="nav-item nav-link">About</a>
                <a href="#service" class="nav-item nav-link">Service</a>
                <a href="{{ route('cari.restaurant') }}" class="nav-item nav-link {{ Route::is('cari.restaurant') ? 'active' : '' }}">Search</a>
                <a href="{{ route('login') }}" class="nav-item nav-link">Add Restaurant</a>
            </div>
            @if (Auth::check())
                <li class="nav-item navbar-dropdown dropdown-user dropdown" style="list-style: none">
                    <a href="javascript:void(0);" data-bs-toggle="dropdown"
                        class="btn text-center fw-semibold rounded-pill text-dark nav-link dropdown-toggle hide-arrow px-4"
                        style="background-color: #FEA116;" id="login">
                        <i class="fa fa-user text-secondary fa-lg text-white"></i>
                        <span class="text-white" style="margin-left: 2px">
                            {{ Str::words(auth()->user()->name, 1, '...') }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end rounded-pill">
                        <li>
                            <a class="dropdown-item rounded-pill" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <span class="align-middle">Log Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <a href="{{ route('auth.signup') }}" class="btn btn-outline-primary py-2 px-4 mx-2">Sign Up</a>
                <a href="{{ route('auth.login') }}" class="btn btn-primary py-2 px-4">Sign In</a>
            @endif
        </div>
    </nav>
