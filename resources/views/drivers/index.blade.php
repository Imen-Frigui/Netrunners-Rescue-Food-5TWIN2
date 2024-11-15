<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="driver-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Drivers Management"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            @if(session('success'))
                <div class="alert alert-success" style="color: white;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card my-4">
                <div
                    class="card-header bg-gradient-success text-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"><strong>Manage Drivers</strong></h6>
                    <a href="{{ route('drivers.create') }}" class="btn btn-light btn-sm text-success">
                        <i class="material-icons">add</i> New Driver
                    </a>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <!-- <form action="{{ route('driver-management') }}" method="GET" class="row g-2 mb-4">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="material-icons">search</i>
                                </span>
                                <input type="text" name="search" class="form-control" placeholder="Search drivers..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Available</option>
                                <option value="busy" {{ request('status') === 'busy' ? 'selected' : '' }}>Busy</option>
                                <option value="offline" {{ request('status') === 'offline' ? 'selected' : '' }}>Offline</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="material-icons">filter_list</i> Filter
                            </button>
                        </div>
                    </form> -->

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('driver-management') }}" method="GET">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="card-title mb-0">Driver Management</h5>
                                    <a href="{{ route('driver-management') }}" class="btn btn-link text-muted btn-sm">
                                        <i class="material-icons align-middle me-1" style="font-size: 16px;">refresh</i>
                                        Clear Filters
                                    </a>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="material-icons text-muted" style="font-size: 20px;">search</i>
                                            </span>
                                            <input type="text" name="search" class="form-control border-start-0 ps-0"
                                                placeholder="Search drivers by name, ID or phone..."
                                                value="{{ request('search') }}" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <select name="status" class="form-select" aria-label="Driver status">
                                            <option value="">All Statuses</option>
                                            <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>
                                                <i class="material-icons">circle</i> Available
                                            </option>
                                            <option value="busy" {{ request('status') === 'busy' ? 'selected' : '' }}>
                                                <i class="material-icons">circle</i> Busy
                                            </option>
                                            <option value="offline" {{ request('status') === 'offline' ? 'selected' : '' }}>
                                                <i class="material-icons">circle</i> Offline
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <button type="submit"
                                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                            <i class="material-icons" style="font-size: 20px;">filter_list</i>
                                            <span>Apply Filters</span>
                                        </button>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>Driver</th>
                                    <th>Phone</th>
                                    <th>Vehicle</th>
                                    <th>Status</th>
                                    <th>Pickup Requests</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drivers as $driver)
                                    <tr class="align-middle">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $driver->profile_image }}" alt="Driver Image"
                                                    class="avatar me-3">
                                                <div>
                                                    <p class="mb-0 fw-bold">{{ $driver->user->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $driver->user->phone }}</td>
                                        <td>{{ $driver->vehicle_type }}</td>
                                        <td>
                                            <span
                                                class="badge 
                                                                    {{ $driver->availability_status == 'available' ? 'bg-success' : ($driver->availability_status == 'busy' ? 'bg-warning' : 'bg-danger') }}">
                                                {{ ucfirst($driver->availability_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($driver->pickupRequests->isEmpty())
                                                <span class="text-muted">None</span>
                                            @else
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($driver->pickupRequests as $request)
                                                        <li>{{ $request->food->name ?? 'Not specified' }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('drivers.edit', $driver->id) }}"
                                                class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a href="#" class="btn btn-outline-danger btn-sm" title="Delete"
                                                onclick="confirmDelete({{ $driver->id }})">
                                                <i class="material-icons">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this driver?
                            </div>
                            <div class="modal-footer">
                                <form id="deleteForm" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                object-fit: cover;
            }

            .table th,
            .table td {
                vertical-align: middle;
            }

            .badge {
                font-size: 0.75rem;
                padding: 0.4em 0.6em;
            }

            .btn-sm {
                font-size: 0.85rem;
                padding: 0.25rem 0.5rem;
            }
        </style>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    window.confirmDelete = function(driverId) {
        const deleteModal = document.getElementById('deleteModal');
        if (!deleteModal) {
            console.error('Delete modal element not found');
            return;
        }
        const modal = new bootstrap.Modal(deleteModal);
        const deleteForm = document.getElementById('deleteForm');
        if (deleteForm) {
            deleteForm.action = `/drivers/${driverId}`;
        }
        modal.show();
    };
});
    </script>
</x-layout>