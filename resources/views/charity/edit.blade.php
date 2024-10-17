<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Update Charity"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Update Charity</h6>
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

                        <!-- Update form -->
                        <form id="charity-update-form" action="{{ route('charities.update', $charity->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Use PUT method for updating -->

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Charity Name -->
                                    <div class="mb-3">
                                        <label for="charity_name" class="form-label">Charity Name</label>
                                        <input type="text" class="form-control border-2 p-2 @error('charity_name') is-invalid @enderror" id="charity_name" name="charity_name" value="{{ old('charity_name', $charity->charity_name) }}" required>
                                        @error('charity_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control border-2 p-2 @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $charity->address) }}" required>
                                        @error('address')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control border-2 p-2 @error('contact_info.email') is-invalid @enderror" id="email" name="contact_info[email]" value="{{ old('contact_info.email', $charity->contact_info['email'] ?? '') }}" required>
                                        @error('contact_info.email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control border-2 p-2 @error('contact_info.phone') is-invalid @enderror" id="phone" name="contact_info[phone]" value="{{ old('contact_info.phone', $charity->contact_info['phone'] ?? '') }}" required>
                                        @error('contact_info.phone')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Charity Type -->
                                    <div class="mb-3">
                                        <label for="charity_type" class="form-label">Charity Type</label>
                                        <input type="text" class="form-control border-2 p-2 @error('charity_type') is-invalid @enderror" id="charity_type" name="charity_type" value="{{ old('charity_type', $charity->charity_type) }}" required>
                                        @error('charity_type')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Beneficiaries Count -->
                                    <div class="mb-3">
                                        <label for="beneficiaries_count" class="form-label">Beneficiaries Count</label>
                                        <input type="number" class="form-control border border-2 p-2 @error('beneficiaries_count') is-invalid @enderror" id="beneficiaries_count" name="beneficiaries_count" value="{{ old('beneficiaries_count', $charity->beneficiaries_count) }}" required>
                                        @error('beneficiaries_count')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Preferred Food Types -->
                                    <div class="mb-3">
                                        <label for="preferred_food_types" class="form-label">Preferred Food Types</label>
                                        <input type="text" class="form-control border border-2 p-2 @error('preferred_food_types') is-invalid @enderror" id="preferred_food_types" name="preferred_food_types" value="{{ old('preferred_food_types', $charity->preferred_food_types) }}">
                                        @error('preferred_food_types')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Request History -->
                                    <div class="mb-3">
                                        <label for="request_history" class="form-label">Request History (JSON)</label>
                                        <textarea class="form-control border border-2 p-2 @error('request_history') is-invalid @enderror" id="request_history" name="request_history" rows="3">{{ old('request_history', $charity->request_history) }}</textarea>
                                        @error('request_history')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Inventory Status -->
                                    <div class="mb-3">
                                        <label for="inventory_status" class="form-label">Inventory Status (JSON)</label>
                                        <textarea class="form-control border border-2 p-2 @error('inventory_status') is-invalid @enderror" id="inventory_status" name="inventory_status" rows="3">{{ old('inventory_status', $charity->inventory_status) }}</textarea>
                                        @error('inventory_status')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                  <!-- Last Received Donation -->
                                  <div class="mb-3">
                                        <label for="last_received_donation" class="form-label">Last Received Donation</label>
                                        <input type="datetime-local" class="form-control border border-2 p-2 @error('last_received_donation') is-invalid @enderror" id="last_received_donation" name="last_received_donation" value="{{ old('last_received_donation', $charity->last_received_donation ? date('Y-m-d\TH:i:s', strtotime($charity->last_received_donation)) : null) }}">
                                        @error('last_received_donation')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Current Requests -->
                            <div class="mb-3">
                                <label for="current_requests" class="form-label">Current Requests</label>
                                <textarea class="form-control border border-2 p-2 @error('current_requests') is-invalid @enderror" id="current_requests" name="current_requests" rows="3">{{ old('current_requests', $charity->current_requests) }}</textarea>
                                @error('current_requests')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Charity Rating -->
                            <div class="mb-3">
                                <label for="charity_rating" class="form-label">Charity Rating</label>
                                <input type="number" step="0.1" class="form-control border border-2 p-2 @error('charity_rating') is-invalid @enderror" id="charity_rating" name="charity_rating" value="{{ old('charity_rating', $charity->charity_rating) }}">
                                @error('charity_rating')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Charity Approval Status -->
                            <div class="mb-3">
    <label for="charity_approval_status" class="form-label">Charity Approval Status</label>
    <select class="form-control border border-2 p-2 @error('charity_approval_status') is-invalid @enderror" id="charity_approval_status" name="charity_approval_status">
        <option value="approved" {{ old('charity_approval_status', $charity->charity_approval_status) === 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="pending" {{ old('charity_approval_status', $charity->charity_approval_status) === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="rejected" {{ old('charity_approval_status', $charity->charity_approval_status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
    </select>
    @error('charity_approval_status')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

                            <!-- Submit Button -->
                            <button type="button" class="btn bg-gradient-dark" onclick="confirmUpdate()">Update</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
<script>
    function confirmUpdate() {
        if (confirm('Are you sure you want to update the charity?')) {
            document.getElementById('charity-update-form').submit();
        }
    }
</script>
