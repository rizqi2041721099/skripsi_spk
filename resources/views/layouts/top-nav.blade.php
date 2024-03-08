<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
        @if (auth()->user()->hasRole('ADMIN'))
            <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                @php
                    $data = App\Models\Restaurant::where('status', '=','0')->get();
                @endphp
                <span class="badge badge-danger badge-counter">{{ $data->count() }}</span>
            </a>
            @if ($data->count() > 0)
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                    Kamu memiliki {{ $data->count() }} restaurant baru
                    </h6>
                    @foreach ($data->take(6) as $item)
                    <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                        <i class="fas fa-building text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</div>
                        <span class="font-weight-bold">{{ $item->name }}</span>
                    </div>
                    </a>
                    @endforeach
                    <a class="dropdown-item text-center small text-gray-500" href="{{ route('list.approve') }}">Show All</a>
                </div>
            @endif
            </li>
        @endif
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img class="img-profile rounded-circle" src="{{ asset('assets/img/boy.png')}}" style="max-width: 60px">
            <span class="ml-2 d-none d-lg-inline text-white small">{{ auth()->user()->name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{ route('profile') }}">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item logout" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" data-toggle="modal"
                data-target="#logoutModal" id="logout">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
          </div>
        </li>
      </ul>
</nav>
