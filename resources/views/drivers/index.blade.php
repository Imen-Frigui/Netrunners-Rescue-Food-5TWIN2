<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="driver-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Drivers Management"></x-navbars.navs.auth>

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
                                <h6 class="text-white mx-3"><strong>Manage Drivers</strong></h6>
                            </div>
                        </div>
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <form action="{{ route('driver-management') }}" method="GET" class="row g-3">
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <span class="input-group-text bg-primary text-white">
                                                        <i class="material-icons">search</i>
                                                    </span>
                                                    <input type="text" name="search" class="form-control"
                                                        placeholder="Search..." value="{{ request('search') }}">
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
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="material-icons">filter_list</i> Filter
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                        <a class="btn btn-success" href="{{ route('drivers.create') }}">
                                            <i class="material-icons">add</i> New Driver
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
                                            Driver Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Phone Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Vehicle Type</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Delivery Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Assigned Pickup Requests</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($drivers as $driver)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $driver->user->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-xs text-secondary mb-0">{{ $driver->phone_number }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $driver->vehicle_type }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <span
                                                        class="text-xs font-weight-bold {{ $driver->availability_status === 'available' ? 'text-success' : ($driver->availability_status === 'busy' ? 'text-warning' : 'text-danger') }}">
                                                        {{ ucfirst($driver->availability_status) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                @if($driver->pickupRequests->isEmpty())
                                                    <span class="text-xs text-danger">No assigned pickup requests</span>
                                                @else
                                                    <ul class="list-unstyled">
                                                        @foreach($driver->pickupRequests as $request)
                                                            <li>{{ $request->food->name ?? 'Food not specified' }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('drivers.edit', $driver->id) }}" class="text-warning me-2"
                                                    title="Edit">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    </main>
</x-layout>