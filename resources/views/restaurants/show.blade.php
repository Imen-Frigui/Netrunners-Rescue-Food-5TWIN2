<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="restaurants"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="View Restaurant"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <h1>{{ $restaurant->name }}</h1>
            <p><strong>Address:</strong> {{ $restaurant->address }}</p>
            <p><strong>Phone:</strong> {{ $restaurant->phone }}</p>
            <p><strong>Email:</strong> {{ $restaurant->email }}</p>

            <!-- Map Container -->
            <div id="map" style="height: 400px; width: 100%; margin-top: 20px;"></div>

            <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning mt-3">Edit</a>
            <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-3">Delete</button>
            </form>
            <a href="{{ route('restaurants') }}" class="btn btn-secondary mt-3">Back to Restaurants</a>
            
            <!-- Button to View Inventory -->
        </div>

        <x-footers.auth></x-footers.auth>
    </main>

    <!-- Leaflet.js CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- Initialize Map -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([{{ $restaurant->latitude }}, {{ $restaurant->longitude }}], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            L.marker([{{ $restaurant->latitude }}, {{ $restaurant->longitude }}]).addTo(map)
                .bindPopup('<strong>{{ $restaurant->name }}</strong><br>{{ $restaurant->address }}')
                .openPopup();
        });
    </script>

    <x-plugins></x-plugins>
</x-layout>
