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
<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="driver-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Create New Driver"></x-navbars.navs.auth>

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
                                <h6 class="text-white mx-3"><strong>Create New Driver</strong></h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="createDriverForm" action="{{ route('drivers.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" >
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input type="text"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                                            >
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                        <input type="text"
                                            class="form-control @error('vehicle_type') is-invalid @enderror"
                                            id="vehicle_type" name="vehicle_type" value="{{ old('vehicle_type') }}"
                                            >
                                        @error('vehicle_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="vehicle_plate_number" class="form-label">Vehicle Plate
                                            Number</label>
                                        <input type="text"
                                            class="form-control @error('vehicle_plate_number') is-invalid @enderror"
                                            id="vehicle_plate_number" name="vehicle_plate_number"
                                            value="{{ old('vehicle_plate_number') }}" >
                                        @error('vehicle_plate_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="license_number" class="form-label">License Number</label>
                                        <input type="text"
                                            class="form-control @error('license_number') is-invalid @enderror"
                                            id="license_number" name="license_number"
                                            value="{{ old('license_number') }}" >
                                        @error('license_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="availability_status" class="form-label">Availability Status</label>
                                        <select class="form-select @error('availability_status') is-invalid @enderror"
                                            id="availability_status" name="availability_status" >
                                            <option value="">Select Status</option>
                                            <option value="available" {{ old('availability_status') == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="busy" {{ old('availability_status') == 'busy' ? 'selected' : '' }}>Busy</option>
                                            <option value="offline" {{ old('availability_status') == 'offline' ? 'selected' : '' }}>Offline</option>
                                        </select>
                                        @error('availability_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">Create Driver</button>
                                    <a href="{{ route('driver-management') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('createDriverForm');

        form.addEventListener('submit', function (event) {
            const inputs = form.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.classList.remove('is-invalid');
                const errorFeedback = input.nextElementSibling;
                if (errorFeedback && errorFeedback.classList.contains('invalid-feedback')) {
                    errorFeedback.style.display = 'none';
                }
            });

            let isValid = true;

            const name = document.getElementById('name').value.trim();
            if (name === '') {
                isValid = false;
                showError('name', 'Name is required');
            }
            const email = document.getElementById('email').value.trim();
            if (email === '') {
                isValid = false;
                showError('email', 'Email is required');
            } else if (!validateEmail(email)) {
                isValid = false;
                showError('email', 'Invalid email format');
            }
            const phoneNumber = document.getElementById('phone_number').value.trim();
            if (phoneNumber === '') {
                isValid = false;
                showError('phone_number', 'Phone number is required');
            } else if (!validatePhoneNumber(phoneNumber)) {
                isValid = false;
                showError('phone_number', 'Invalid phone number format');
            }

            const vehicleType = document.getElementById('vehicle_type').value.trim();
            if (vehicleType === '') {
                isValid = false;
                showError('vehicle_type', 'Vehicle type is required');
            }

            const vehiclePlateNumber = document.getElementById('vehicle_plate_number').value.trim();
            if (vehiclePlateNumber === '') {
                isValid = false;
                showError('vehicle_plate_number', 'Vehicle plate number is required');
            }

            const licenseNumber = document.getElementById('license_number').value.trim();
            if (licenseNumber === '') {
                isValid = false;
                showError('license_number', 'License number is required');
            }

            const availabilityStatus = document.getElementById('availability_status').value.trim();
            if (availabilityStatus === '') {
                isValid = false;
                showError('availability_status', 'Availability status is required');
            }

            if (!isValid) {
                event.preventDefault(); 
            }
        });

        function showError(inputId, message) {
            const input = document.getElementById(inputId);
            const errorFeedback = input.nextElementSibling;
            input.classList.add('is-invalid');
            errorFeedback.textContent = message;
            errorFeedback.style.display = 'block';
        }

        function validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        function validatePhoneNumber(phoneNumber) {
            const regex = /^[0-9]+$/;
            return regex.test(phoneNumber);
        }
    });
</script>
