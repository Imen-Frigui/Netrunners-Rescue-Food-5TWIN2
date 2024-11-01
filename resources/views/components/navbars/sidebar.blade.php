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


    </div>


    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <!-- Dashboard Route - Now on Top -->
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

            <!-- Laravel Examples Section -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">User Profile
                    Section</h6>
            </li>

            <!-- User Profile Route -->
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-profile' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('user-profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-circle ps-2 pe-2 text-center" style="font-size: 1.2rem;"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Profile</span>
                </a>
            </li>

            <!-- Pages Section -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Management Section
                </h6>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'events' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('events.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="nav-link-text ms-1">Events Management</span>
                </a>
            </li>
            <!-- Sponsors Management -->
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'sponsors' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('sponsors.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sponsors Management</span>
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
                <a class="nav-link text-white {{ $activePage == 'pickup-management' ? ' active bg-gradient-success' : '' }} "
                    href="{{ route('pickup-management') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-truck"></i>
                    </div>
                    <span class="nav-link-text ms-1">PickUps Management</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'reviews' ? ' active bg-gradient-success' : '' }}  "
                    class="nav-link" href="{{ route('reviews') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="nav-link-text ms-1">Reviews Management</span>
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
            </li>
            <!-- Other existing pages -->
            {{-- <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'tables' ? ' active bg-gradient-primary' : '' }} "
            href="{{ route('tables') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Tables</span>
            </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'billing' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('billing') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Billing</span>
                </a>
            </li> --}}


            {{-- <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'virtual-reality' ? ' active bg-gradient-primary' : '' }} "
            href="{{ route('virtual-reality') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Virtual Reality</span>
            </a>
            </li> --}}

            {{-- <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'rtl' ? ' active bg-gradient-primary' : '' }} "
            href="{{ route('rtl') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
            </div>
            <span class="nav-link-text ms-1">RTL</span>
            </a>
            </li> --}}

            {{-- <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'notifications' ? ' active bg-gradient-primary' : '' }} "
            href="{{ route('notifications') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Notifications</span>
            </a>
            </li> --}}

            <!-- Account Pages Section -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'profile' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('static-sign-in') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Sign In</span>
            </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('static-sign-up') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li> --}}
        </ul>
    </div>
</aside>