<meta name="csrf-token" content="{{ csrf_token() }}">
<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="pickup-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="PickUp Requests Management"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            @if(session('success'))
                <div class="alert alert-success" style="color: white;">
                    {{ session('success') }}
                </div>
            @endif
            <div id="messageArea" class="alert alert-success" style="display: none; color: white;"></div>
            <div class="row align-items-center mb-3">
                <div class="col-md-8">
                    <form action="{{ route('pickup-management') }}" method="GET" class="row g-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="material-icons">search</i>
                                </span>
                                <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="status" id="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="material-icons">filter_list</i> Filter
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a class="btn btn-success" href="{{ route('pickup.create') }}">
                        <i class="material-icons">add</i> New Pickup Request
                    </a>
                </div>
            </div>

            <div class="row">
                @foreach($pickupRequests as $request)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100 driver-card">
                            <div class="card-header bg-gradient-success text-white">
                                <h6 class="text-white mb-0">Pickup #{{ $request->id }}</h6>
                            </div>
                            <div class="card-body">
                                <p><strong>Customer:</strong> {{ $request->user->name }}</p>
                                <p><strong>Location:</strong> {{ $request->pickup_address }}</p>
                                <p><strong>Date:</strong> {{ $request->pickup_time }}</p>
                                <p><strong>Created:</strong> {{ $request->created_at->format('d/m/Y') }}</p>
                                <div class="d-flex align-items-center">
                                    <span class="status-indicator {{ $request->status == 'approved' ? 'status-available' : ($request->status == 'pending' ? 'status-busy' : 'status-rejected') }}"></span>
                                    <span class="text-secondary">{{ ucfirst($request->status) }}</span>
                                </div>
                                <div class="mt-3 d-flex justify-content-between">
                                    <a href="{{ route('pickup.edit', $request->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="material-icons">edit</i> Edit
                                    </a>
                                    <div>
                                        @if($request->status === 'pending')
                                            <a href="{{ route('pickup.accept', $request->id) }}" class="text-success me-2" title="Accept">
                                                <i class="material-icons">check_circle</i>
                                            </a>
                                            <a href="{{ route('pickup.reject', $request->id) }}" class="text-danger" title="Reject">
                                                <i class="material-icons">cancel</i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    @if($request->driver)
                                        <div>
                                            <p><strong>Driver:</strong> {{ $request->driver->user->name }}</p>
                                            <p><small>Phone: {{ $request->driver->user->phone }}</small></p>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeDriver({{ $request->id }})">
                                                <i class="material-icons">remove_circle</i> Remove Driver
                                            </button>
                                        </div>
                                    @elseif($request->status === 'approved')
                                        <button type="button" class="btn btn-success btn-sm" onclick="openDriverModal({{ $request->id }})">
                                            <i class="material-icons">person_add</i> Assign Driver
                                        </button>
                                    @else
                                        <span class="text-secondary">No driver assigned</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Driver Assignment Modal -->
        <div class="modal fade" id="assignDriverModal" tabindex="-1" aria-labelledby="assignDriverModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignDriverModalLabel">Assign Driver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3" id="driversList">
                            <!-- List drivers dynamically here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .input-group-text {
                border: none;
            }

            .form-control,
            .form-select,
            .btn {
                border-radius: 0.25rem;
            }

            .material-icons {
                font-size: 1rem;
                vertical-align: middle;
            }

            .driver-card {
                transition: transform 0.2s ease;
                cursor: pointer;
            }

            .driver-card:hover {
                transform: scale(1.03);
            }

            .status-indicator {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                display: inline-block;
                margin-right: 8px;
            }

            .status-available {
                background-color: green;
            }

            .status-busy {
                background-color: orange;
            }

            .status-rejected {
                background-color: red;
            }
        </style>


        <script>
            let currentPickupId = null;

            function openDriverModal(pickupId) {
                console.log("clicked")
                currentPickupId = pickupId;
                fetch(`/api/available-drivers`)
                    .then(response => response.json())
                    .then(drivers => {
                        const driversHtml = drivers.map(driver => `
                 <div class="row mb-3">
                    <div class="col-12">
                        <div class="card driver-card ${driver.availability_status === 'available' ? 'available' : 'busy'} shadow-sm" 
                             onclick="assignDriver(${driver.id}, ${pickupId})">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-title mb-0 d-flex align-items-center">
                                        <span class="status-indicator ${driver.availability_status === 'available' ? 'status-available' : 'status-busy'} me-2"></span>
                                        ${driver.user.name}
                                    </h6>
                                    <span class="badge ${driver.availability_status === 'available' ? 'bg-success' : 'bg-danger'}">
                                        ${driver.availability_status}
                                    </span>
                                </div>
                                <p class="card-text text-secondary mt-2 mb-0">
                                    <i class="material-icons">phone</i> ${driver.phone_number}
                                </p>
                                <p class="card-text text-secondary mb-0">
                                    <i class="material-icons">directions_car</i> ${driver.vehicle_type}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                        `).join('');

                        document.getElementById('driversList').innerHTML = driversHtml;
                        new bootstrap.Modal(document.getElementById('assignDriverModal')).show();
                    });
            }
            function assignDriver(driverId, pickupId) {
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfTokenMeta ? csrfTokenMeta.content : '';

                fetch(`/pickup/${pickupId}/assign-driver`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ driver_id: driverId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showMessage('Driver assigned successfully!');
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            console.log(data)
                            alert('Failed to assign driver. Please try again.');
                        }
                    });
            }
            function removeDriver(pickupRequestId) {
                fetch(`/pickup/remove-driver/${pickupRequestId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showMessage('Driver removed successfully!');
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to remove driver');
                    });

            }
            function showMessage(message) {
                const messageArea = document.getElementById('messageArea');
                messageArea.textContent = message;
                messageArea.style.display = 'block';
                setTimeout(() => {
                    messageArea.style.display = 'none';
                }, 3000);
            }
        </script>
    </main>


    </html>
</x-layout>