<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="pickup-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Edit PickUp Request"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong>Edit PickUp Request</strong></h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <form action="{{ route('pickup.update', $pickup->id) }}" method="POST" class="p-4">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="pickup_address" class="form-label">Pickup Address</label>
                                    <input type="text" class="form-control" id="pickup_address" name="pickup_address"
                                        value="{{ old('pickup_address', $pickup->pickup_address) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pickup_time" class="form-label">Pickup Time</label>
                                    <input type="datetime-local" class="form-control" id="pickup_time"
                                        name="pickup_time" value="{{ old('pickup_time', $pickup->pickup_time) }}"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="pending" {{ old('status', $pickup->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ old('status', $pickup->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ old('status', $pickup->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update PickUp Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>