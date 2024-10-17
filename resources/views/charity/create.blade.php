<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Add New Charity"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="card my-4">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Add New Charity</h6>
                    </div>
                </div>
                <div class="card-body px-4 py-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Charity Information</h5>
                        <a href="{{ route('charities') }}" class="btn bg-gradient-dark">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Charity Form -->
                    <form action="{{ route('charities.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Charity Name -->
                                <div class="mb-3">
                                    <label for="charity_name" class="form-label">Charity Name</label>
                                    <input type="text" class="form-control border border-2 p-2 @error('charity_name') is-invalid @enderror" id="charity_name" name="charity_name" value="{{ old('charity_name') }}" required>
                                    <small class="form-text text-muted">Required, max 255 characters</small>
                                    @error('charity_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control border border-2 p-2 @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                                    <small class="form-text text-muted">Required, max 255 characters</small>
                                    @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <!-- Contact Info -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control border border-2 p-2 @error('contact_info.email') is-invalid @enderror" id="email" name="contact_info[email]" value="{{ old('contact_info.email') }}" required>
                                    <small class="form-text text-muted">Required, valid email format</small>
                                    @error('contact_info.email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control border border-2 p-2 @error('contact_info.phone') is-invalid @enderror" id="phone" name="contact_info[phone]" value="{{ old('contact_info.phone') }}" required>
                                    <small class="form-text text-muted">Required, max 15 characters</small>
                                    @error('contact_info.phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <!-- Charity Type -->
                                <div class="mb-3">
                                    <label for="charity_type" class="form-label">Charity Type</label>
                                    <select class="form-control border border-2 p-2 @error('charity_type') is-invalid @enderror" id="charity_type" name="charity_type" required>
                                        <option value="" disabled selected>Select a Charity Type</option>
                                        <option value="food_bank" {{ old('charity_type') == 'food_bank' ? 'selected' : '' }}>Food Bank</option>
                                        <option value="shelter" {{ old('charity_type') == 'shelter' ? 'selected' : '' }}>Shelter</option>
                                        <option value="soup_kitchen" {{ old('charity_type') == 'soup_kitchen' ? 'selected' : '' }}>Soup Kitchen</option>
                                    </select>
                                    <small class="form-text text-muted">Required</small>
                                    @error('charity_type') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <!-- Beneficiaries Count -->
                                <div class="mb-3">
                                    <label for="beneficiaries_count" class="form-label">Beneficiaries Count</label>
                                    <input type="number" min="1" class="form-control border border-2 p-2 @error('beneficiaries_count') is-invalid @enderror" id="beneficiaries_count" name="beneficiaries_count" value="{{ old('beneficiaries_count') }}" required>
                                    <small class="form-text text-muted">Required, must be at least 1</small>
                                    @error('beneficiaries_count') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Preferred Food Types -->
                                <div class="mb-3">
                                    <label for="preferred_food_types" class="form-label">Preferred Food Type</label>
                                    <select class="form-control border border-2 p-2 @error('preferred_food_types') is-invalid @enderror" id="preferred_food_types" name="preferred_food_types">
                                        <option value="" disabled selected>Select a Food Type</option>
                                        <option value="vegetables" {{ old('preferred_food_types') == 'vegetables' ? 'selected' : '' }}>Vegetables</option>
                                        <option value="fruits" {{ old('preferred_food_types') == 'fruits' ? 'selected' : '' }}>Fruits</option>
                                        <option value="meat" {{ old('preferred_food_types') == 'meat' ? 'selected' : '' }}>Meat</option>
                                        <option value="grains" {{ old('preferred_food_types') == 'grains' ? 'selected' : '' }}>Grains</option>
                                    </select>
                                    <small class="form-text text-muted">Optional, select one food type.</small>
                                    @error('preferred_food_types') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <!-- Last Received Donation -->
                                <div class="mb-3">
                                    <label for="last_received_donation" class="form-label">Last Received Donation</label>
                                    <input type="date" class="form-control border border-2 p-2 @error('last_received_donation') is-invalid @enderror" id="last_received_donation" name="last_received_donation" value="{{ old('last_received_donation') }}">
                                    <small class="form-text text-muted">Optional, date of last received donation.</small>
                                    @error('last_received_donation') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <!-- Donation Frequency -->
                                <div class="mb-3">
    <label for="donation_frequency" class="form-label">Donation Frequency (1 = Weekly, 2 = Monthly, 3 = Annually)</label>
    <input type="number" class="form-control border border-2 p-2 @error('donation_frequency') is-invalid @enderror" id="donation_frequency" name="donation_frequency" min="1" value="{{ old('donation_frequency') }}" required>
    <small class="form-text text-muted">Required, input frequency as 1 (weekly), 2 (monthly), or 3 (annually).</small>
    @error('donation_frequency') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>


                                <!-- Assigned Drivers/Volunteers -->
                                <div class="mb-3">
                                    <label for="assigned_drivers_volunteers" class="form-label">Assigned Drivers/Volunteers</label>
                                    <input type="text" class="form-control border border-2 p-2 @error('assigned_drivers_volunteers') is-invalid @enderror" id="assigned_drivers_volunteers" name="assigned_drivers_volunteers" value="{{ old('assigned_drivers_volunteers') }}">
                                    <small class="form-text text-muted">Optional, list assigned drivers/volunteers.</small>
                                    @error('assigned_drivers_volunteers') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <!-- Charity Rating -->
                                <div class="mb-3">
                                    <label for="charity_rating" class="form-label">Charity Rating</label>
                                    <input type="number" min="1" max="5" class="form-control border border-2 p-2 @error('charity_rating') is-invalid @enderror" id="charity_rating" name="charity_rating" value="{{ old('charity_rating') }}">
                                    <small class="form-text text-muted">Optional, rate the charity from 1 to 5.</small>
                                    @error('charity_rating') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <!-- Charity Approval Status -->
                                <div class="mb-3">
                                    <label for="charity_approval_status" class="form-label">Charity Approval Status</label>
                                    <select class="form-control border border-2 p-2 @error('charity_approval_status') is-invalid @enderror" id="charity_approval_status" name="charity_approval_status">
                                        <option value="" disabled selected>Select Approval Status</option>
                                        <option value="approved" {{ old('charity_approval_status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="pending" {{ old('charity_approval_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="rejected" {{ old('charity_approval_status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    <small class="form-text text-muted">Optional, status of the charity's approval.</small>
                                    @error('charity_approval_status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <!-- Inventory Status -->
                                <div class="mb-3">
                                    <label for="inventory_status" class="form-label">Inventory Status</label>
                                    <textarea class="form-control border border-2 p-2 @error('inventory_status') is-invalid @enderror" id="inventory_status" name="inventory_status" rows="3">{{ old('inventory_status') }}</textarea>
                                    <small class="form-text text-muted">Optional, describe the inventory status here.</small>
                                    @error('inventory_status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <!-- Current Requests -->
                                <div class="mb-3">
                                    <label for="current_requests" class="form-label">Current Requests</label>
                                    <textarea class="form-control border border-2 p-2 @error('current_requests') is-invalid @enderror" id="current_requests" name="current_requests" rows="3">{{ old('current_requests') }}</textarea>
                                    <small class="form-text text-muted">Optional, max 1000 characters</small>
                                    @error('current_requests') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn bg-gradient-dark" id="submit-button" disabled>Add</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const inputs = document.querySelectorAll('input[required], textarea[required], select[required]');
            const submitButton = document.getElementById('submit-button');

            function checkInputs() {
                let allFilled = true;

                inputs.forEach(input => {
                    if (input.value.trim() === '') {
                        allFilled = false;
                        input.classList.add('border-danger');
                    } else {
                        input.classList.remove('border-danger');
                    }
                });

                submitButton.disabled = !allFilled;
            }

            inputs.forEach(input => {
                input.addEventListener('input', checkInputs);
                input.addEventListener('change', checkInputs);
            });
        });
    </script>
</x-layout>
