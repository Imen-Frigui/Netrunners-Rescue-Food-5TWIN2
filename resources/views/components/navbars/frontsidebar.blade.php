@props(['activePage'])

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">

    <!-- Sidebar Header with Logo -->
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href="{{ route('front-office.index') }}" style="max-height: 120px; display: block;">
            <img src="{{ asset('assets') }}/img/rescuefood.svg" class="navbar-brand-img" alt="logo" style="max-height: 2000px; margin-bottom:40px">
        </a>

        <!-- Include Font Awesome 5 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </div>

    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <!-- Front Office Section -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Front Office</h6>
            </li>

            <!-- Dashboard Route -->
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'index' ? ' active bg-gradient-primary' : '' }}" href="{{ route('front-office.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-home"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <!-- Events Section -->
            <li class="nav-item">
                <a class="nav-link text-white {{ str_contains($activePage, 'events') ? ' active bg-gradient-success' : '' }}" href="{{ route('front-office.events.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="nav-link-text ms-1">Events</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'showEvent' ? ' active bg-gradient-success' : '' }}" href="{{ route('front-office.events.show', ['event' => 'your-event-slug']) }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <span class="nav-link-text ms-1">Restaurant</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
