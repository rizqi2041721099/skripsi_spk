<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        {{-- <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/img/logo/bca_logo.png') }}">
        </div> --}}
        <div class="sidebar-brand-text mx-3">Project Name</div>
    </a>
    <hr class="sidebar-divider my-0">
        <li class="nav-item {{ $page == 'dashboard' ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDashboard"
                aria-expanded="true" aria-controls="collapseDashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <div id="collapseDashboard" class="collapse {{ $page == 'dashboard' ? 'show' : '' }}"
                aria-labelledby="headingPage" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">List Dashboard</h6>
                        <a class="collapse-item {{ request()->is('home*') ? 'active' : '' }}"
                            href="{{ route('home') }}">Dashboard</a>
                </div>
            </div>
        </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>
    @if (auth()->user()->can('list-kriteria'))
        <li class="nav-item {{ request()->is('kriterias*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kriterias.index') }}">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Kriteria</span>
            </a>
        </li>
    @endif
    @if (auth()->user()->can('list-restaurant') && auth()->user()->hasRole('ADMIN'))
        <li class="nav-item {{ $page == 'restaurants' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('restaurants.index') }}">
                <i class="fa fa-building"></i>
                <span>Restaurants</span>
            </a>
        </li>
    @endif
    @if (auth()->user()->can('create-restaurant') && auth()->user()->hasRole('USER') )
        <li class="nav-item {{ $page == 'restaurants' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('restaurants.create') }}">
                <i class="fa fa-building"></i>
                <span>Add Restaurants</span>
            </a>
        </li>
    @endif
    @if (auth()->user()->can('list-alternatif'))
        <li class="nav-item {{ request()->is('alternatif*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('alternatif.index') }}">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Alternatif</span>
            </a>
        </li>
    @endif
    @if (auth()->user()->can('perhitungan-saw'))
    <li class="nav-item {{ request()->is('perhitungan.saw*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('perhitungan.saw') }}">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Perhitungan SAE</span>
        </a>
    </li>
    @endif
    {{-- @if (auth()->user()->hasRole('ADMIN'))
    <li class="nav-item {{ $page == 'master' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Master</span>
        </a>
        <div id="collapseBootstrap" class="collapse  {{ $page == 'master' ? 'show' : '' }}"
            aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Master</h6>
                <a class="collapse-item {{ request()->is('food-variaties*') ? 'active' : '' }}"
                    href="{{ route('food-variaties.index') }}">Food Variatys</a>
                <a class="collapse-item {{ request()->is('facilities*') ? 'active' : '' }}"
                    href="{{ route('facilities.index') }}">Facilities</a>
            </div>
        </div>
    </li>
    @endif --}}
    @if (auth()->user()->can('list-users') ||
    auth()->user()->can('list-role'))
        <li class="nav-item {{ $page == 'management-users' ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable"
                aria-expanded="true" aria-controls="collapseTable">
                <i class="fa fa-users"></i>
                <span>Management Users</span>
            </a>
            <div id="collapseTable" class="collapse {{ $page == 'management-users' ? 'show' : '' }}"
                aria-labelledby="headingPage" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">List Management Users</h6>
                    @can('list-users')
                     <a class="collapse-item {{ request()->is('users*') ? 'active' : '' }}"
                        href="{{ route('users.index') }}">Users</a>
                    @endcan
                    @can('list-role')
                        <a class="collapse-item {{ request()->is('roles*') ? 'active' : '' }}"
                            href="{{ route('roles.index') }}">Role</a>
                    @endcan
                </div>
            </div>
        </li>
    @endif
    @if (auth()->user()->hasRole('ADMIN'))
    <li class="nav-item {{ $page == 'settings' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
            aria-expanded="true" aria-controls="collapseSettings">
            <i class="fa fa-cogs"></i>
            <span>Pengaturan</span>
        </a>
        <div id="collapseSettings" class="collapse {{ $page == 'settings' ? 'show' : '' }}"
            aria-labelledby="headingPage" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="">Cleaner</a>
            </div>
        </div>
    </li>
    @endif
</ul>
