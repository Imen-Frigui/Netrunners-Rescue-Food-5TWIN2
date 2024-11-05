<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="my-pickups"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="My Pickups"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <h4 class="text-center my-4"><strong>Assigned Pickups</strong></h4>

            <div class="row">
                @forelse($pickupRequests as $request)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title mb-2">
                                    <i class="material-icons text-primary">location_on</i>
                                    Pickup Location
                                </h5>
                                <p class="card-text text-secondary">{{ $request->location }}</p>

                                <h6 class="mt-3"><i class="material-icons text-warning">fastfood</i> Food Item</h6>
                                <p class="text-muted mb-1">{{ $request->food->name ?? 'Food not specified' }}</p>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span
                                        class="badge {{ $request->status === 'completed' ? 'bg-success' : ($request->status === 'pending' ? 'bg-warning' : 'bg-secondary') }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                    <a href="#" class="btn btn-outline-primary btn-sm" data-request-id="{{ $request->id }}">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No assigned pickups</p>
                    </div>
                @endforelse
            </div>

        </div>
        <div id="mapModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary">
                        <h5 class="modal-title text-white">
                            <i class="material-icons align-middle">route</i>
                            Delivery Route Details
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div id="pickup-map" style="height: 600px;"></div>
                            </div>
                            <div class="col-md-4 border-start">
                                <div class="p-4">
                                    <div class="delivery-info mb-4">
                                        <h6 class="text-primary fw-bold mb-3">
                                            <i class="material-icons align-middle">info</i>
                                            Delivery Information
                                        </h6>
                                        <div class="card bg-light border-0 mb-3">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="text-muted small">Status</label>
                                                    <div class="status-badge"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-muted small">Pickup Location</label>
                                                    <p class="pickup-address mb-0 fw-bold"></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-muted small">Food Items</label>
                                                    <p class="food-items mb-0"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="route-info">
                                        <h6 class="text-primary fw-bold mb-3">
                                            <i class="material-icons align-middle">timeline</i>
                                            Route Details
                                        </h6>
                                        <div class="card bg-light border-0">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="material-icons text-success">schedule</i>
                                                    <div class="ms-3">
                                                        <label class="text-muted small">Estimated Time</label>
                                                        <p class="estimated-time mb-0 fw-bold"></p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="material-icons text-primary">straighten</i>
                                                    <div class="ms-3">
                                                        <label class="text-muted small">Total Distance</label>
                                                        <p class="total-distance mb-0 fw-bold"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="driver-info mt-4">
                                        <h6 class="text-primary fw-bold mb-3">
                                            <i class="material-icons align-middle">person</i>
                                            Driver Details
                                        </h6>
                                        <div class="card bg-light border-0">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="driver-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                        style="width: 48px; height: 48px;">
                                                        <i class="material-icons">local_shipping</i>
                                                    </div>
                                                    <div>
                                                        <h6 class="driver-name mb-1 fw-bold"></h6>
                                                        <p class="driver-phone mb-0 text-muted small"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <script>
let map;
let pickupMarker;
let driverMarker;
let routingControl;

function initializeMap(pickupLat, pickupLng, driverLat, driverLng) {
    if (map) {
        map.remove();
    }

    map = L.map('pickup-map', {
        zoomControl: false 
    });

    L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    L.control.zoom({
        position: 'topright'
    }).addTo(map);

    const pickupIcon = L.divIcon({
        html: `
            <div class="custom-marker-icon pickup-icon">
                <i class="material-icons">location_on</i>
            </div>
        `,
        className: 'custom-div-icon',
        iconSize: [40, 40],
        iconAnchor: [20, 40]
    });

    const driverIcon = L.divIcon({
        html: `
            <div class="custom-marker-icon driver-icon">
                <i class="material-icons">local_shipping</i>
            </div>
        `,
        className: 'custom-div-icon',
        iconSize: [40, 40],
        iconAnchor: [20, 40]
    });

    pickupMarker = L.marker([pickupLat, pickupLng], {icon: pickupIcon})
        .bindPopup('<b>Pickup Location</b><br>Customer Waiting', {
            className: 'custom-popup'
        })
        .addTo(map);

    driverMarker = L.marker([driverLat, driverLng], {icon: driverIcon})
        .bindPopup('<b>Driver Location</b><br>On the way', {
            className: 'custom-popup'
        })
        .addTo(map);

    if (routingControl) {
        map.removeControl(routingControl);
    }

    routingControl = L.Routing.control({
        waypoints: [
            L.latLng(driverLat, driverLng),
            L.latLng(pickupLat, pickupLng)
        ],
        routeWhileDragging: false,
        showAlternatives: false,
        addWaypoints: false,
        draggableWaypoints: false,
        fitSelectedRoutes: true,
        lineOptions: {
            styles: [
                {color: 'white', opacity: 0.9, weight: 9},
                {color: '#2196F3', opacity: 0.7, weight: 6}
            ]
        },
        createMarker: function() { return null; } 
    }).addTo(map);

    routingControl.on('routesfound', function(e) {
        const routes = e.routes;
        const route = routes[0]; 

        const distance = (route.summary.totalDistance / 1000).toFixed(1);
        const time = Math.round(route.summary.totalTime / 60);
        
        document.querySelector('.total-distance').textContent = `${distance} km`;
        document.querySelector('.estimated-time').textContent = `${time} minutes`;
    });
}

document.querySelectorAll('.btn-outline-primary').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        
        const requestId = this.getAttribute('data-request-id');
        
        const modal = new bootstrap.Modal(document.getElementById('mapModal'));
        modal.show();
        
        fetch(`/pickup-locations/${requestId}`)
            .then(response => response.json())
            .then(data => {
                initializeMap(
                    data.pickup_latitude,
                    data.pickup_longitude,
                    data.driver_latitude,
                    data.driver_longitude
                );
                
                document.querySelector('.pickup-address').textContent = data.location;
                document.querySelector('.food-items').textContent = data.food_items;
                document.querySelector('.driver-name').textContent = data.driver_name;
                document.querySelector('.driver-phone').textContent = data.driver_phone;
                
                const statusBadge = document.querySelector('.status-badge');
                statusBadge.className = 'status-badge badge ' + 
                    (data.status === 'completed' ? 'bg-success' : 
                     data.status === 'pending' ? 'bg-warning' : 'bg-secondary');
                statusBadge.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
            })
            .catch(error => console.error('Error:', error));
    });
});
</script>

<style>
#pickup-map {
    border-radius: 0;
    box-shadow: none;
}

.custom-marker-icon {
    background: white;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #fff;
}

.custom-marker-icon.pickup-icon {
    background: #f44336;
}

.custom-marker-icon.pickup-icon i {
    color: white;
}

.custom-marker-icon.driver-icon {
    background: #2196F3;
}

.custom-marker-icon.driver-icon i {
    color: white;
}

.custom-marker-icon i {
    font-size: 20px;
}

.custom-popup {
    border-radius: 8px;
}

.leaflet-routing-container {
    background: white;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin: 10px;
}

.modal-xl {
    max-width: 1200px;
}

.delivery-info, .route-info, .driver-info {
    position: relative;
}

.material-icons {
    font-size: 20px;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
</style>
</x-layout>