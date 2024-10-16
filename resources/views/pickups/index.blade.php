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
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Add, Edit, Delete the Pickups Requests</strong>
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


    </html>
</x-layout>