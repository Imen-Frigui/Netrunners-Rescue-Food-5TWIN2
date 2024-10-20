
<meta name="csrf-token" content="{{ csrf_token() }}">
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="pickup-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="PickUp Requests Management"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            @if(session('success'))
                <div class="alert alert-success" style="color: white;">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Manage Pickups Requests</strong>
                                </h6>
                            </div>
                        </div>
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <form action="{{ route('pickup-management') }}" method="GET" class="row g-3">
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <span class="input-group-text bg-primary text-white">
                                                        <i class="material-icons">search</i>
                                                    </span>
                                                    <input type="text" name="search" class="form-control"
                                                        placeholder="Search..." value="{{ request('search') }}">
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
                            </div>
                        </div>

                        <div class="table-responsive p-0">

                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Pickup Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            CUSTOMER NAME</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            PICKUP LOCATION</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            DATE OF Pickup</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            STATUS</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            DATE OF CREATION</th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Accept/Reject</th>

                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ASSIGNED DRIVER</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pickupRequests as $request)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $request->id }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-xs text-secondary mb-0 ">{{ $request->user->name }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs text-secondary mb-0">{{ $request->pickup_address }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $request->pickup_time }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="status-label {{ $request->status === 'approved' ? 'text-success' : ($request->status === 'pending' ? 'text-warning' : '') }}">
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $request->created_at->format('d/m/Y') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('pickup.edit', $request->id) }}" class="text-warning me-2"
                                                    title="Edit">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if($request->status === 'pending')
                                                    <a href="{{ route('pickup.accept', $request->id) }}"
                                                        class="text-success me-2" title="Accept">
                                                        <i class="material-icons">check_circle</i>
                                                    </a>
                                                    <a href="{{ route('pickup.reject', $request->id) }}" class="text-danger"
                                                        title="Reject">
                                                        <i class="material-icons">cancel</i>
                                                    </a>
                                                @else

                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if($request->driver)
                                                    <div class="d-flex flex-column align-items-center">
                                                        <span
                                                            class="text-xs font-weight-bold mb-0">{{ $request->driver->user->name }}</span>
                                                        <span
                                                            class="text-secondary text-xs">{{ $request->driver->user->phone }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-secondary text-xs">No driver assigned</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if(!$request->driver && $request->status === 'approved')
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        onclick="openDriverModal({{ $request->id }})">
                                                        <i class="material-icons">person_add</i> Assign Driver
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="assignDriverModal" tabindex="-1"
                        aria-labelledby="assignDriverModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="assignDriverModalLabel">Assign Driver</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3" id="driversList">
                                    </div>
                                </div>
                            </div>
                        </div>
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
        </style>
        <style>
            .driver-card {
                cursor: pointer;
                transition: transform 0.2s;
            }

            .driver-card:hover {
                transform: scale(1.02);
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
    console.log(driverId)
    console.log(pickupId)
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
                            location.reload();
                        } else {
                            console.log(data)
                            alert('Failed to assign driver. Please try again.');
                        }
                    });
            }
        </script>
    </main>


    </html>
</x-layout>