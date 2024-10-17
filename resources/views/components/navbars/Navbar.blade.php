@props(['activePage'])

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light custom-navbar fixed-top">
    <div class="container-fluid">
        <!-- Navbar Brand -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('front-office.index') }}">
        <img src="{{ asset('assets/img/logo1.png') }}" alt="logo" style="width: 120px; height: auto;">
            
        </a>

        <!-- Include Font Awesome 5 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- Navbar Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Home Route -->
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'index' ? 'active' : '' }}"
                       href="{{ route('front-office.index') }}">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>

                <!-- About Us -->
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'about' ? 'active' : '' }}"
                    href="{{ route('front-office.about') }}">

                        <i class="fas fa-info-circle"></i>
                        <span>About Us</span>
                    </a>
                </li>

                <!-- Events Section -->
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'events' ? 'active' : '' }}"
                       href="{{ route('events.all') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Events</span>
                    </a>
                </li>

                 <!-- Resturant Section -->
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'restaurants' ? 'active' : '' }}"
                       href="{{ route('restaurants', ['restaurants' => 'your-restaurant-slug']) }}">
                        <i class="fas fa-calendar-day"></i>
                        <span>Resturant</span>
                    </a>
                </li>

                <!-- Donations Section -->
                <li class="nav-item">
                    <a class="nav-link {{ str_contains($activePage, 'donations') ? 'active' : '' }}"
                       href="{{ route('donations') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Donations</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'showDonations' ? 'active' : '' }}"
                       href="{{ route('donations.show') }}">
                        <i class="fas fa-calendar-day"></i>
                        <span>Donations</span>
                    </a>
                </li> --}}

                <!-- User Profile Gadget (Moved to Last) -->
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'user-front' ? 'active' : '' }}" 
                       href="{{ route('front-office.profile') }}">
                        <i class="fas fa-user-cog"></i>
                        <span> Profile</span>
                    </a>
                </li>
                                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                        @csrf
                    </form>
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" 
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-user me-sm-1 text-danger"></i>
                        <span class="text-danger">Sign Out</span> <!-- Apply text-danger class for Bootstrap -->
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Custom CSS -->
<style>
/* Navbar Styles */
.custom-navbar {
    background-color: white; /* Set background to white */
    padding: 0.5rem 1rem; /* Reduce padding for a smaller navbar */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Reduced shadow for a lighter look */
}

.custom-navbar .navbar-logo {
    max-height: 50px; /* Decrease logo size */
    margin-right: 10px;
}

.custom-navbar .navbar-title {
    font-size: 1.5rem; /* Reduce title font size */
    font-weight: bold;
    color: #11998e; /* Change title color to match the button color */
    margin-left: 10px; /* Maintain spacing */
}

.custom-navbar .navbar-nav .nav-item .nav-link {
    color: #11998e; /* Change text color for links */
    font-size: 1rem; /* Reduce font size */
    font-weight: 500;
    padding: 0.5rem 1rem; /* Adjust padding for smaller touch targets */
    border-radius: 0.25rem;
    transition: all 0.3s ease;
}

/* Icon and Text Spacing */
.custom-navbar .navbar-nav .nav-item .nav-link i {
    margin-right: 8px;
}

/* Hover Effects */
.custom-navbar .navbar-nav .nav-item .nav-link:hover {
    background-color: rgba(17, 153, 142, 0.1); /* Light green on hover */
    color: #11998e; /* Keep the text color the same */
}

.custom-navbar .navbar-nav .nav-item .nav-link.active {
    background: rgba(17, 153, 142, 0.2); /* Light green for active links */
    color: #11998e; /* Keep the active text color the same */
}

/* Navbar Brand Logo Animation */
.custom-navbar .navbar-brand:hover .navbar-logo {
    transform: scale(1.05);
}

/* Navbar Toggler */
.navbar-toggler {
    border-color: rgba(17, 153, 142, 0.5); /* Toggler color */
}

/* Responsive Styles */
@media (max-width: 992px) {
    .custom-navbar .navbar-nav .nav-item .nav-link {
        text-align: center;
    }
}
</style>
