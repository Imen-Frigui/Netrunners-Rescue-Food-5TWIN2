<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="restaurants"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Create Restaurant"></x-navbars.navs.auth>
        
        <div class="container-fluid py-4">
            <h1>Create New Restaurant</h1>
            
            <form action="{{ route('restaurants.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control border @error('name') is-invalid @enderror" value="{{ old('name') }}" >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control border @error('address') is-invalid @enderror" value="{{ old('address') }}" >
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control border @error('phone') is-invalid @enderror" value="{{ old('phone') }}" >
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control border @error('email') is-invalid @enderror" value="{{ old('email') }}" >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Latitude and Longitude inputs (hidden) -->
                <input type="hidden" name="latitude" id="latitude" >
                <input type="hidden" name="longitude" id="longitude" >

                <!-- Map Container -->
                <div id="map" style="height: 400px; width: 100%;"></div>

                <button type="submit" class="btn btn-primary mt-3">Create Restaurant</button>
                <a href="{{ route('restaurants') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>

        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>

    <!-- Include Leaflet.js and Leaflet.css for OpenStreetMap -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Initialize the map -->
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13); // Initial map view (default: London)
        
        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;

        // Click event listener on map to add marker
        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker); // Remove existing marker
            }
            marker = L.marker(e.latlng).addTo(map); // Add new marker
            document.getElementById('latitude').value = e.latlng.lat.toFixed(7); // Set latitude value
            document.getElementById('longitude').value = e.latlng.lng.toFixed(7); // Set longitude value
        });
    </script>
</x-layout>
