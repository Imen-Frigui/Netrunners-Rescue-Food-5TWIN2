@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">

    <!-- Sidebar Header with Logo -->
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href="{{ route('dashboard') }}"
            style="max-height: 120px; display: block;">
            <img src="{{ asset('assets') }}/img/rescuefood.svg" class="navbar-brand-img" alt="logo1"
                style="max-height: 2000px; margin-bottom:40px">
        </a>

        <!-- Include Font Awesome 5 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    </div>

    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <!-- Dashboard Route -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8"></h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <!-- User Profile Section -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">User Profile Section</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-profile' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('user-profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-circle ps-2 pe-2 text-center" style="font-size: 1.2rem;"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Profile</span>
                </a>
            </li>

            @if(auth()->check())
            @if(auth()->user()->user_type === "driver")
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Driver Section</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'assigned-pickups' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('my-pickups') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-box"></i>
                    </div>
                    <span class="nav-link-text ms-1">My Assigned Pickup Requests</span>
                </a>
            </li>
            @elseif(auth()->user()->user_type === "admin")
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Management Section</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'events' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('events.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="nav-link-text ms-1">Events Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'restaurants' ? ' active bg-gradient-success' : '' }}"
                    href="{{ route('restaurants') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-store"></i>
                    </div>
                    <span class="nav-link-text ms-1">Restaurants Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'charities' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('charities') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <span class="nav-link-text ms-1">Charities Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'food-management' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('foods.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <span class="nav-link-text ms-1">Food Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'donation-management' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('donation-management.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-donate"></i>
                    </div>
                    <span class="nav-link-text ms-1">Donations Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'pickup-management' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('pickup-management') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-truck"></i>
                    </div>
                    <span class="nav-link-text ms-1">PickUps Management</span>
                </a>
            </li>
            <li class="nav-item">
                        <a class="nav-link text-white {{ $activePage == 'driver-management' ? ' active bg-gradient-success' : '' }} "
                            href="{{ route('driver-management') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-truck"></i>
                            </div>
                            <span class="nav-link-text ms-1">Drivers Management</span>
                        </a>
                </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'reviews' ? ' active bg-gradient-success' : '' }}  "
                    href="{{ route('reviews') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="nav-link-text ms-1">Reviews Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'inventories' ? ' active bg-gradient-success' : '' }}  "
                    href="{{ route('inventories.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="nav-link-text ms-1">inventories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-management' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('user-management') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-lg fas fa-users text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Users Management</span>
                </a>
            </li>
            @endif
            @endif

        </ul>
    </div>
</aside>