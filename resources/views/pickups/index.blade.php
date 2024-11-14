<meta name="csrf-token" content="{{ csrf_token() }}">
<x-layout bodyClass="g-sidenav-show bg-gray-100">
    <x-navbars.sidebar activePage="pickup-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="PickUp Requests Management"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="material-icons">check_circle</i></span>
                    <span class="alert-text">{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Search and Filter Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('pickup-management') }}" method="GET"
                                class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <div class="input-group input-group-dynamic">
                                        <span class="input-group-text bg-gradient-primary text-white">
                                            <i class="material-icons">search</i>
                                        </span>
                                        <input type="text" name="search" class="form-control ps-3"
                                            placeholder="Search by customer or location..."
                                            value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select name="status" class="form-select border ps-3">
                                        <option value="">All Status</option>
                                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                            Approved</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                            Rejected</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn bg-gradient-info w-100 mb-0">
                                        <i class="material-icons me-2">filter_list</i> Filter
                                    </button>
                                </div>
                                <div class="col-md-3 text-end">
                                    <a href="{{ route('pickup.create') }}" class="btn bg-gradient-success w-100 mb-0">
                                        <i class="material-icons me-2">add</i> New Request
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pickup Requests Grid -->
            <div class="row">
                @foreach($pickupRequests as $request)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg pickup-card h-100">
                            <div
                                class="card-header p-3 bg-gradient-{{ $request->status == 'approved' ? 'success' : ($request->status == 'pending' ? 'warning' : 'danger') }}">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-white mb-0">Pickup #{{ $request->id }}</h6>
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="badge bg-light text-dark">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="timeline timeline-one-side">
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step bg-primary">
                                            <i class="material-icons text-white">person</i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark mb-0">{{ $request->user->name }}</h6>
                                            <p class="text-secondary font-weight-normal text-sm">Customer</p>
                                        </div>
                                    </div>

                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step bg-success">
                                            <i class="material-icons text-white">location_on</i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark mb-0">Pickup Location</h6>
                                            <p class="text-secondary font-weight-normal text-sm">
                                                {{ $request->pickup_address }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="timeline-block">
                                        <span class="timeline-step bg-info">
                                            <i class="material-icons text-white">schedule</i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark mb-0">Pickup Time</h6>
                                            <p class="text-secondary font-weight-normal text-sm">{{ $request->pickup_time }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions Section -->
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <a href="{{ route('pickup.edit', $request->id) }}" class="btn btn-outline-info btn-sm">
                                        <i class="material-icons">edit</i> Edit
                                    </a>
                                    @if($request->status === 'pending')
                                        <div>
                                            <button onclick="window.location.href='{{ route('pickup.accept', $request->id) }}'"
                                                class="btn btn-success btn-sm me-2">
                                                <i class="material-icons">check_circle</i>
                                            </button>
                                            <button onclick="window.location.href='{{ route('pickup.reject', $request->id) }}'"
                                                class="btn btn-danger btn-sm">
                                                <i class="material-icons">cancel</i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Driver Section -->
                            <div class="card-footer p-3 bg-light">
                                @if($request->driver)
                                    <div class="driver-info">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="material-icons text-primary me-2">local_shipping</i>
                                            <h6 class="mb-0">Assigned Driver</h6>
                                        </div>
                                        <div class="ps-4">
                                            <p class="mb-1"><strong>{{ $request->driver->user->name }}</strong></p>
                                            <p class="text-sm mb-2">
                                                <i class="material-icons text-sm me-1">phone</i>
                                                {{ $request->driver->user->phone }}
                                            </p>
                                            <button class="btn btn-outline-danger btn-sm w-100"
                                                onclick="removeDriver({{ $request->id }})">
                                                <i class="material-icons">remove_circle</i> Remove Driver
                                            </button>
                                        </div>
                                    </div>
                                @elseif($request->status === 'approved')
                                    <button class="btn bg-gradient-primary btn-sm w-100"
                                        onclick="openDriverModal({{ $request->id }})">
                                        <i class="material-icons me-2">person_add</i> Assign Driver
                                    </button>
                                @else
                                    <p class="text-center text-secondary mb-0">No driver assigned</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Driver Assignment Modal -->
        <div class="modal fade" id="assignDriverModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary">
                        <h5 class="modal-title text-white">Assign Driver</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3" id="driversList"></div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .pickup-card {
                transition: all 0.3s ease;
            }

            .pickup-card:hover {
                transform: translateY(-5px);
            }

            .timeline {
                margin: 0;
                padding: 0;
                list-style: none;
            }

            .timeline-block {
                display: flex;
                align-items: flex-start;
            }

            .timeline-step {
                width: 35px;
                height: 35px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
            }

            .timeline-step i {
                font-size: 1rem;
            }

            .timeline-content {
                flex: 1;
            }

            .form-select {
                height: 42px;
            }

            .input-group-text {
                padding: 0.625rem 1rem;
            }

            .driver-card {
                cursor: pointer;
                transition: transform 0.2s ease;
                border: 2px solid transparent;
            }

            .driver-card:hover {
                transform: translateY(-3px);
                border-color: #4CAF50;
            }

            .driver-card.busy:hover {
                border-color: #FFA726;
            }

            .status-indicator {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                display: inline-block;
                margin-right: 8px;
            }

            .status-available {
                background-color: #4CAF50;
            }

            .status-busy {
                background-color: #FFA726;
            }
        </style>

        <script>
            let currentPickupId = null;


            function openDriverModal(pickupId) {
                currentPickupId = pickupId;
                fetch(`/api/available-drivers`)
                    .then(response => response.json())
                    .then(drivers => {
                        const driversHtml = drivers.map(driver => `
                            <div class="col-md-6 mb-3">
                                <div class="card driver-card ${driver.availability_status === 'available' ? '' : 'busy'}" 
                                     onclick="assignDriver(${driver.id}, ${pickupId})">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="status-indicator ${driver.availability_status === 'available' ? 'status-available' : 'status-busy'}"></span>
                                                <h6 class="mb-0">${driver.user.name}</h6>
                                            </div>
                                            <span class="badge bg-${driver.availability_status === 'available' ? 'success' : 'warning'}">
                                                ${driver.availability_status}
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center text-sm text-secondary mb-2">
                                            <i class="material-icons me-2">phone</i>
                                            ${driver.user.phone}
                                        </div>
                                        <div class="d-flex align-items-center text-sm text-secondary">
                                            <i class="material-icons me-2">directions_car</i>
                                            ${driver.vehicle_type}
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
                        'X-CSRF-TOKEN': csrfToken,
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
                            alert('Failed to assign driver. Please try again.');
                        }
                    });
            }

            function removeDriver(pickupRequestId) {
                if (confirm('Are you sure you want to remove the driver from this pickup request?')) {
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
                                alert(data.message || 'Failed to remove driver');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Failed to remove driver');
                        });
                }
            }
            function showMessage(message) {
                const messageArea = document.createElement('div');
                messageArea.className = 'alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3';
                messageArea.style.zIndex = '1050';
                messageArea.innerHTML = `
        <span class="alert-icon"><i class="material-icons">check_circle</i></span>
        <span class="alert-text">${message}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    `;
                document.body.appendChild(messageArea);

                setTimeout(() => {
                    messageArea.remove();
                }, 3000);
            }
        </script>
    </main>
</x-layout>