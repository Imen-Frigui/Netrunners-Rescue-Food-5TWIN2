<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add New Charity"></x-navbars.navs.auth>
        <!-- End Navbar -->
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
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('charities.store') }}" method="POST">
                            @csrf <!-- CSRF token for security -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="charity_name" class="form-label">Charity Name</label>
                                        <input type="text" class="form-control border border-2 p-2 @error('charity_name') is-invalid @enderror" id="charity_name" name="charity_name" value="{{ old('charity_name') }}" required>
                                        @error('charity_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control border border-2 p-2 @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                                        @error('address')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control border border-2 p-2 @error('contact_info.email') is-invalid @enderror" id="email" name="contact_info[email]" value="{{ old('contact_info.email') }}" required>
                                        @error('contact_info.email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control border border-2 p-2 @error('contact_info.phone') is-invalid @enderror" id="phone" name="contact_info[phone]" value="{{ old('contact_info.phone') }}" required>
                                        @error('contact_info.phone')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="charity_type" class="form-label">Charity Type</label>
                                        <input type="text" class="form-control border border-2 p-2 @error('charity_type') is-invalid @enderror" id="charity_type" name="charity_type" value="{{ old('charity_type') }}" required>
                                        @error('charity_type')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="beneficiaries_count" class="form-label">Beneficiaries Count</label>
                                        <input type="number" class="form-control border border-2 p-2 @error('beneficiaries_count') is-invalid @enderror" id="beneficiaries_count" name="beneficiaries_count" value="{{ old('beneficiaries_count') }}" required>
                                        @error('beneficiaries_count')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="preferred_food_types" class="form-label">Preferred Food Types</label>
                                        <input type="text" class="form-control border border-2 p-2 @error('preferred_food_types') is-invalid @enderror" id="preferred_food_types" name="preferred_food_types" value="{{ old('preferred_food_types') }}">
                                        @error('preferred_food_types')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="request_history" class="form-label">Request History (JSON)</label>
                                        <textarea class="form-control border border-2 p-2 @error('request_history') is-invalid @enderror" id="request_history" name="request_history" rows="3">{{ old('request_history') }}</textarea>
                                        @error('request_history')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inventory_status" class="form-label">Inventory Status (JSON)</label>
                                        <textarea class="form-control border border-2 p-2 @error('inventory_status') is-invalid @enderror" id="inventory_status" name="inventory_status" rows="3">{{ old('inventory_status') }}</textarea>
                                        @error('inventory_status')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="last_received_donation" class="form-label">Last Received Donation</label>
                                        <input type="date" class="form-control border border-2 p-2 @error('last_received_donation') is-invalid @enderror" id="last_received_donation" name="last_received_donation" value="{{ old('last_received_donation') }}">
                                        @error('last_received_donation')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="donation_frequency" class="form-label">Donation Frequency</label>
                                        <input type="text" class="form-control border border-2 p-2 @error('donation_frequency') is-invalid @enderror" id="donation_frequency" name="donation_frequency" value="{{ old('donation_frequency') }}">
                                        @error('donation_frequency')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="assigned_drivers_volunteers" class="form-label">Assigned Drivers/Volunteers</label>
                                        <input type="text" class="form-control border border-2 p-2 @error('assigned_drivers_volunteers') is-invalid @enderror" id="assigned_drivers_volunteers" name="assigned_drivers_volunteers" value="{{ old('assigned_drivers_volunteers') }}">
                                        @error('assigned_drivers_volunteers')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="current_requests" class="form-label">Current Requests</label>
                                <textarea class="form-control border border-2 p-2 @error('current_requests') is-invalid @enderror" id="current_requests" name="current_requests" rows="3">{{ old('current_requests') }}</textarea>
                                @error('current_requests')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="charity_rating" class="form-label">Charity Rating</label>
                                <input type="number" step="0.1" class="form-control border border-2 p-2 @error('charity_rating') is-invalid @enderror" id="charity_rating" name="charity_rating" value="{{ old('charity_rating') }}">
                                @error('charity_rating')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="charity_approval_status" class="form-label">Charity Approval Status</label>
                                <select class="form-control border border-2 p-2 @error('charity_approval_status') is-invalid @enderror" id="charity_approval_status" name="charity_approval_status">
                                    <option value="approved" {{ old('charity_approval_status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="pending" {{ old('charity_approval_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="rejected" {{ old('charity_approval_status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                @error('charity_approval_status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add Charity</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
