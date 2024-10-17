<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Add New Charity"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="card my-4">
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
    <select class="form-control border border-2 p-2 @error('preferred_food_types') is-invalid @enderror" 
            id="preferred_food_types" 
            name="preferred_food_types"> <!-- Remove brackets -->
        <option value="" disabled selected>Select a Food Type</option> <!-- Default option -->
        <option value="vegetables" {{ old('preferred_food_types') == 'vegetables' ? 'selected' : '' }}>Vegetables</option>
        <option value="fruits" {{ old('preferred_food_types') == 'fruits' ? 'selected' : '' }}>Fruits</option>
        <option value="meat" {{ old('preferred_food_types') == 'meat' ? 'selected' : '' }}>Meat</option>
        <option value="grains" {{ old('preferred_food_types') == 'grains' ? 'selected' : '' }}>Grains</option>
    </select>
    <small class="form-text text-muted">Optional, select one food type.</small>
    @error('preferred_food_types') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>






                                <!-- Optional: Other Info -->
                                <div class="mb-3">
                                    <label for="request_history" class="form-label">Request History</label>
                                    <textarea class="form-control border border-2 p-2 @error('request_history') is-invalid @enderror" id="request_history" name="request_history" rows="3">{{ old('request_history') }}</textarea>
                                    <small class="form-text text-muted">Optional, describe the request history here.</small>
                                    @error('request_history') <span class="invalid-feedback">{{ $message }}</span> @enderror
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
