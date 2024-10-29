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
                                    <span class="badge {{ $request->status === 'completed' ? 'bg-success' : ($request->status === 'pending' ? 'bg-warning' : 'bg-secondary') }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                    <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
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
    </main>
</x-layout>

<style>
    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
    }
    .card-text, .text-muted {
        font-size: 0.9rem;
    }
    .material-icons {
        font-size: 1.2rem;
        vertical-align: middle;
        margin-right: 5px;
    }
</style>
