<x-layout bodyClass="bg-gray-200">
    <x-navbars.Navbar activePage="restaurants"></x-navbars.Navbar>

    <x-navbars.navs.auth titlePage="Restaurant Details"></x-navbars.navs.auth>

    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
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
    <h5 class="text-primary">Restaurant Information</h5>
    <p><strong>Address:</strong> {{ $restaurant->address }}</p>
    <p><strong>Phone:</strong> {{ $restaurant->phone }}</p>
    <p><strong>Email:</strong> {{ $restaurant->email }}</p>

    <h5 class="text-primary mt-4">Available Foods</h5>
    @if($restaurant->foods->isEmpty())
        <p>No foods available at this restaurant.</p>
    @else
        <ul class="list-group">
            @foreach($restaurant->foods as $food)
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
                                                @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    <!-- Rest of your code -->
</div>

                                <!-- Map Container -->
                                <div id="map" style="height: 400px; margin-top: 20px;"></div>

                                <div class="text-center mt-4">
                                    <a href="{{ route('restaurants.all') }}" class="btn bg-gradient-primary w-100 mb-2">Back to All Restaurants</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
