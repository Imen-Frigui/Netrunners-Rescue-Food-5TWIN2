<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="driver-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Create New Driver"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="text-white">{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong class="text-white">Please check the form for errors</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong>Create New Driver</strong></h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <form action="{{ route('drivers.store') }}" method="POST" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="input-group input-group-outline @error('name') is-invalid @enderror">
                                            <label class="form-label">Name</label>
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   name="name" 
                                                   value="{{ old('name') }}"
                                                   required>
                                        </div>
                                        @error('name')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="input-group input-group-outline @error('email') is-invalid @enderror">
                                            <label class="form-label">Email</label>
                                            <input type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   name="email" 
                                                   value="{{ old('email') }}"
                                                   required>
                                        </div>
                                        @error('email')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="input-group input-group-outline @error('phone') is-invalid @enderror">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" 
                                                   class="form-control @error('phone') is-invalid @enderror" 
                                                   name="phone" 
                                                   value="{{ old('phone') }}"
                                                   required>
                                        </div>
                                        @error('phone')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="input-group input-group-outline @error('vehicle_type') is-invalid @enderror">
                                            <label class="form-label">Vehicle Type</label>
                                            <input type="text" 
                                                   class="form-control @error('vehicle_type') is-invalid @enderror" 
                                                   name="vehicle_type" 
                                                   value="{{ old('vehicle_type') }}"
                                                   required>
                                        </div>
                                        @error('vehicle_type')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="input-group input-group-outline @error('vehicle_plate_number') is-invalid @enderror">
                                            <label class="form-label">Vehicle Plate Number</label>
                                            <input type="text" 
                                                   class="form-control @error('vehicle_plate_number') is-invalid @enderror" 
                                                   name="vehicle_plate_number" 
                                                   value="{{ old('vehicle_plate_number') }}"
                                                   required>
                                        </div>
                                        @error('vehicle_plate_number')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="input-group input-group-outline @error('license_number') is-invalid @enderror">
                                            <label class="form-label">License Number</label>
                                            <input type="text" 
                                                   class="form-control @error('license_number') is-invalid @enderror" 
                                                   name="license_number" 
                                                   value="{{ old('license_number') }}"
                                                   required>
                                        </div>
                                        @error('license_number')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="input-group input-group-static @error('availability_status') is-invalid @enderror">
                                            <label for="availability_status" class="ms-0">Availability Status</label>
                                            <select class="form-control" name="availability_status" required>
                                                <option value="">Select Status</option>
                                                <option value="available" {{ old('availability_status') == 'available' ? 'selected' : '' }}>
                                                    Available
                                                </option>
                                                <option value="busy" {{ old('availability_status') == 'busy' ? 'selected' : '' }}>
                                                    Busy
                                                </option>
                                                <option value="offline" {{ old('availability_status') == 'offline' ? 'selected' : '' }}>
                                                    Offline
                                                </option>
                                            </select>
                                        </div>
                                        @error('availability_status')
                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn bg-gradient-success">Create Driver</button>
                                        <a href="{{ route('driver-management') }}" class="btn bg-gradient-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
