@extends('components.front-office')

@section('content')
<x-navbars.Navbar activePage='index'></x-navbars.Navbar>
<x-navbars.navs.auth titlePage="User Interface"></x-navbars.navs.auth>

<!-- Hero Section -->
<div class="hero-section position-relative">
    <img src="{{ asset('assets/img/donation1.jpg') }}" class="position-absolute w-100 h-100 top-0 start-0" style="object-fit: cover; z-index: -1;" alt="Background Image">
    
    <!-- Background Overlay -->
    <div class="hero-overlay"></div>

    <div class="hero-content text-center text-white position-relative" style="z-index: 1;">
        <h1 class="display-4 font-weight-bold text-success">Welcome to Rescue Food</h1>
        <p class="lead mb-5">Explore our Restaurants and Available food below.</p>
    </div>
</div>

<div class="container mt-5">
    <!-- Restaurants Section -->
    <h2 class="text-secondary">Restaurants</h2>
    <div class="text-center my-4">
        <img src="{{ asset('assets/img/resturants.jpg') }}" class="img-fluid" style="width: 100%; max-height: 200px; object-fit: cover;" alt="Restaurants Image">
    </div>
    <div class="row" id="restaurant-list">
        @foreach ($restaurants as $restaurant)
            <div class="col-lg-4 col-md-6 mb-4 restaurant-item">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-secondary">{{ $restaurant->name }}</h3>
                        <p class="card-text">{{ $restaurant->address }}</p>
                        <a href="#" class="btn btn-outline-secondary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <button class="btn btn-outline-secondary mt-3" id="show-more-restaurants">Show More</button>

    <!-- Image between sections -->
 

    <!-- Foods Section -->
    <h2 class="text-primary mt-5">Foods Available</h2>
    <div class="text-center my-4">
        <img src="{{ asset('assets/img/food.jpg') }}" class="img-fluid" style="width: 100%; max-height: 200px; object-fit: cover;" alt="Restaurants Image">
    </div>
    <div class="row" id="food-list">
        @foreach ($foods as $food)
            <div class="col-lg-4 col-md-6 mb-4 food-item">
                <div class="card border-primary shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-primary">{{ $food->food_name }}</h3>
                        <p class="card-text">expiring in : {{ $food->expiration_date }}</p>
                      
                        <a href="#" class="btn btn-outline-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button class="btn btn-outline-primary mt-3" id="show-more-foods">Show More</button>

    <!-- Image between sections -->
<!-- Charities Section -->
<h2 class="text-info mt-5">Charities</h2>
<div class="text-center my-4">
    <img src="{{ asset('assets/img/donation2.jpg') }}" class="img-fluid" style="width: 100%; max-height: 200px; object-fit: cover;" alt="Charities Image">
</div>
<div class="row" id="charity-list">
    @foreach ($charities as $charity)
        <div class="col-lg-4 col-md-6 mb-4 charity-item">
            <div class="card border-info shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-info">{{ $charity->charity_name }}</h3>
                    <p class="card-text">{{ Str::limit($charity->address, 50) }}</p>
                 
                    <p class="card-text"><strong>Beneficiaries:</strong> {{ $charity->beneficiaries_count }}</p>
                    <a href="#" class="btn btn-outline-info">View Details</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
<button class="btn btn-outline-primary mt-3" id="show-more-charities">Show More</button>

<!-- Image between sections -->

    <!-- Events Section -->
    <h2 class="text-success mt-5">Upcoming Events</h2>
    <div class="text-center my-4">
        <img src="{{ asset('assets/img/donation1.jpg') }}" class="img-fluid" style="width: 100%; max-height: 200px; object-fit: cover;" alt="Foods Image">
    </div>
    <div class="row" id="event-list">
        @foreach ($events as $event)
            <div class="col-lg-4 col-md-6 mb-4 event-item">
                <div class="card border-success shadow-sm" style="height: 100%;"> <!-- Ensure full height of parent -->
                    <div class="card-body d-flex flex-column"> <!-- Flex column to allow proper distribution -->
                        <h3 class="card-title text-success">{{ $event->title }}</h3>
                        <p class="card-text flex-grow-1">{{ $event->description }}</p> <!-- Allow description to take space -->
                        <p class="text-muted">Date: {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-success mt-auto">View Details</a> <!-- Push button to bottom -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button class="btn btn-outline-success mt-3" id="show-more-events">Show More</button>
    

</div>

<style>
    .hero-section {
        height: 60vh; /* Adjust height as needed */
        position: relative;
        overflow: hidden;
        width: 100vw; /* Full viewport width */
        margin-left: calc((100% - 100vw) / 2); /* Center the hero section */
        margin-right: calc((100% - 100vw) / 2); /* Center the hero section */
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5); /* Dark overlay with 50% opacity */
        z-index: 0; /* Below the content */
    }

    .hero-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 1;
    }

    .hero-content h1 {
        font-size: 3rem; /* Large font for the hero title */
        font-weight: bold;
    }

    .hero-content p {
        font-size: 1.5rem; /* Larger font for the lead text */
    }

    .card-body {
        height: 250px; /* Set a fixed height as needed */
        overflow: hidden; /* Hide overflow content */
    }

    .card-text {
        max-height: 100px; /* Limit the height of the description */
        overflow: hidden; /* Hide overflow */
        text-overflow: ellipsis; /* Add ellipsis for overflowed text */
    }
</style>

<script>
    // JavaScript for Show More functionality
    document.addEventListener('DOMContentLoaded', function() {
        let restaurantCounter = 3; // Number of items to show initially
        const restaurantItems = document.querySelectorAll('.restaurant-item');
        const showMoreRestaurants = document.getElementById('show-more-restaurants');

        showMoreRestaurants.addEventListener('click', function() {
            restaurantCounter += 3; // Show 3 more items
            for (let i = 0; i < restaurantCounter && i < restaurantItems.length; i++) {
                restaurantItems[i].style.display = 'block';
            }
            if (restaurantCounter >= restaurantItems.length) {
                showMoreRestaurants.style.display = 'none'; // Hide button if no more items
            }
        });

        // Foods
        let foodCounter = 3; // Number of items to show initially
        const foodItems = document.querySelectorAll('.food-item');
        const showMoreFoods = document.getElementById('show-more-foods');

        showMoreFoods.addEventListener('click', function() {
            foodCounter += 3; // Show 3 more items
            for (let i = 0; i < foodCounter && i < foodItems.length; i++) {
                foodItems[i].style.display = 'block';
            }
            if (foodCounter >= foodItems.length) {
                showMoreFoods.style.display = 'none'; // Hide button if no more items
            }
        });

        // Events
        let eventCounter = 3; // Number of items to show initially
        const eventItems = document.querySelectorAll('.event-item');
        const showMoreEvents = document.getElementById('show-more-events');

        showMoreEvents.addEventListener('click', function() {
            eventCounter += 3; // Show 3 more items
            for (let i = 0; i < eventCounter && i < eventItems.length; i++) {
                eventItems[i].style.display = 'block';
            }
            if (eventCounter >= eventItems.length) {
                showMoreEvents.style.display = 'none'; // Hide button if no more items
            }
        });

        let charityCounter = 3; // Number of items to show initially
        const charityItems = document.querySelectorAll('.charity-item');
        const showMoreCharities = document.getElementById('show-more-charities');

        showMoreCharities.addEventListener('click', function() {
            charityCounter += 3; // Show 3 more items
            for (let i = 0; i < charityCounter && i < charityItems.length; i++) {
                charityItems[i].style.display = 'block';
            }
            if (charityCounter >= charityItems.length) {
                showMoreCharities.style.display = 'none'; // Hide button if no more items
            }
        });

        // Initial hide for items beyond the first three
        restaurantItems.forEach((item, index) => {
            if (index >= restaurantCounter) {
                item.style.display = 'none';
            }
        });

        foodItems.forEach((item, index) => {
            if (index >= foodCounter) {
                item.style.display = 'none';
            }
        });

        eventItems.forEach((item, index) => {
            if (index >= eventCounter) {
                item.style.display = 'none';
            }
        });
        charityItems.forEach((item, index) => {
            if (index >= charityCounter) {
                item.style.display = 'none';
            }
        });
  
    });
</script>
@endsection
