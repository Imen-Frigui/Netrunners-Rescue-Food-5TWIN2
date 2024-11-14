<x-layout bodyClass="bg-gray-200">
    <x-navbars.Navbar activePage="restaurants"></x-navbars.Navbar>

    <x-navbars.navs.auth titlePage="Restaurant Details"></x-navbars.navs.auth>

    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
            <img src="{{ asset('assets/img/donation1.jpg') }}" class="position-absolute w-100 h-100 top-0 start-0" style="object-fit: cover; z-index: -1;" alt="Background Image">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-12 mt-8 mb-4">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">{{ $restaurant->name }}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                            <div class="text-start mt-4 text" >
                            Add a Review    <a href="{{ route('myreviewcreateResto', ['restaurantId' => $restaurant->id]) }}" 
   class="btn-icon position-relative" 
   style="display: inline-flex; align-items: center; justify-content: center; 
          width: 50px; height: 50px; border-radius: 50%; background-color: #f39c12; 
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); transition: all 0.3s ease-in-out;">
    <svg xmlns="http://www.w3.org/2000/svg" 
         fill="currentColor" 
         viewBox="0 0 24 24" 
         width="24" height="24" 
         style="color: #fff;">
        <path d="M12 17.27L18.18 21 16.54 14.97 22 10.24 15.81 9.63 12 3.8 8.19 9.63 2 10.24 7.46 14.97 5.82 21z"/>
        <path d="M0 0h24v24H0z" fill="none"/>
    </svg>
</a>

<style>
    .btn-icon:hover {
        transform: scale(1.1);
        background-color: #e67e22;
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.4);
    }
</style>
    <h5 class="text-primary">Restaurant Information</h5>
    <p><strong>Address:</strong> {{ $restaurant->address }}</p>
    <p><strong>Phone:</strong> {{ $restaurant->phone }}</p>
    <p><strong>Email:</strong> {{ $restaurant->email }}</p>

    <h5 class="text-primary mt-4">Available Foods from Inventory</h5>
@if($foods->isEmpty())
    <p>No foods available in the inventory.</p>
@else
    <ul class="list-group">
    @foreach($foods as $food)
    <li class="list-group-item">
        <h5 class="font-weight-bold">{{ $food->food_name }}</h5>
        <p class="mb-1">{{ $food->description }}</p>
        <p class="text-muted">Status: {{$food->status}}</p>
        <p class="text-muted">Expiring in: {{$food->expiration_date}}</p>

        <form action="{{ route('pickup.quick-add', ['restaurant_id' => $restaurant->id, 'food_id' => $food->id]) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="btn bg-gradient-success w-30 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Pick up Request
            </button>
        </form>

        @if(session('success') && session('success')['food_id'] == $food->id)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success')['message'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error') && session('error')['food_id'] == $food->id)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error')['message'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </li>
@endforeach
    </ul>
@endif
    <!-- Rest of your code -->
</div>

                                <!-- Map Container -->
                                <div id="map" style="height: 400px; margin-top: 20px;"></div>

                                    <a href="{{ route('restaurants.all') }}" class="btn bg-gradient-primary w-100 mb-2">Back to All Restaurants</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

<!-- Reviews Section -->
<div class="container mt-4">
    <h5 class="text-center text-primary mb-4">Reviews</h5>

    @if($reviews->isEmpty())
        <p>No reviews available for this restaurant.</p>
    @else
        <div class="review-container overflow-auto">
            <ul class="list-group d-flex flex-nowrap">
                @foreach($reviews as $review)
                    <li class="list-group-item flex-shrink-0 mx-2" style="min-width: 250px;">
                        <h6 class="font-weight-bold">{{ $review->user->name }}</h6>
                        <p>{{ $review->comment }}</p>
                        <div class="d-flex align-items-center">
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">★</span>
                                @endfor
                            </div>
                            <p class="text-muted ml-2 mb-0">Reviewed on: {{ $review->created_at->format('d M Y') }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<style>
    .star {
        color: #ccc; /* Default star color */
        font-size: 1.25rem; /* Adjust star size */
    }
    .star.filled {
        color: #FFD700; /* Gold color for filled stars */
    }
    .rating {
        display: flex;
        align-items: center; /* Center stars vertically */
    }
    .review-container {
        overflow-x: auto; /* Enable horizontal scrolling */
        white-space: nowrap; /* Prevent line breaks */
        padding: 1rem 0; /* Add padding for aesthetics */
    }
    .list-group-item {
        border: 1px solid #e0e0e0; /* Add border for better visibility */
        border-radius: 5px; /* Rounded corners */
        background-color: #f8f9fa; /* Light background for contrast */
    }
    .list-group {
        padding: 0; /* Remove default padding */
    }
</style>

        </div>
    </main>

    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

    <!-- Leaflet.js JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <script>
        // Initialize the map
        var map = L.map('map').setView([{{ $restaurant->latitude }}, {{ $restaurant->longitude }}], 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Add a marker for the restaurant
        L.marker([{{ $restaurant->latitude }}, {{ $restaurant->longitude }}])
            .addTo(map)
            .bindPopup('<b>{{ $restaurant->name }}</b><br>{{ $restaurant->address }}')
            .openPopup();
    </script>
</x-layout>
