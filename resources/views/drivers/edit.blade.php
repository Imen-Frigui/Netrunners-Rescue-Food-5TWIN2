<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="driver-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Edit Driver"></x-navbars.navs.auth>

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
                            <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong>Edit Driver</strong></h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="editDriverForm" action="{{ route('drivers.update', $driver->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Important for updating data -->

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $driver->user->name) }}" >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $driver->user->email) }}" >
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone', $driver->user->phone) }}" >
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                        <input type="text"
                                            class="form-control @error('vehicle_type') is-invalid @enderror"
                                            id="vehicle_type" name="vehicle_type" value="{{ old('vehicle_type', $driver->vehicle_type) }}" >
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
                                            value="{{ old('vehicle_plate_number', $driver->vehicle_plate_number) }}" >
                                        @error('vehicle_plate_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="license_number" class="form-label">License Number</label>
                                        <input type="text"
                                            class="form-control @error('license_number') is-invalid @enderror"
                                            id="license_number" name="license_number"
                                            value="{{ old('license_number', $driver->license_number) }}" >
                                        @error('license_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="availability_status" class="form-label">Availability Status</label>
                                        <select class="form-select @error('availability_status') is-invalid @enderror"
                                            id="availability_status" name="availability_status" >
                                            <option value="">Select Status</option>
                                            <option value="available" {{ old('availability_status', $driver->availability_status) == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="busy" {{ old('availability_status', $driver->availability_status) == 'busy' ? 'selected' : '' }}>Busy</option>
                                            <option value="offline" {{ old('availability_status', $driver->availability_status) == 'offline' ? 'selected' : '' }}>Offline</option>
                                        </select>
                                        @error('availability_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-warning">Update Driver</button>
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
        const form = document.getElementById('editDriverForm');

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
