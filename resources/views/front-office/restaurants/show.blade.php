<x-layout bodyClass="bg-gray-200">
    <x-navbars.Navbar activePage="restaurants"></x-navbars.Navbar>

    <x-navbars.navs.auth titlePage="Restaurant Details"></x-navbars.navs.auth>

    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-12 mt-8 mb-4">
                        <!-- Centered content -->
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

            <x-footers.guest></x-footers.guest>
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
