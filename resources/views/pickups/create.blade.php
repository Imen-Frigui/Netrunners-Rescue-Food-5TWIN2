<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="pickup-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Add PickUp Request"></x-navbars.navs.auth>
        
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="text-white mx-3 my-0">
                                        <i class="material-icons me-2">add_circle</i>
                                        <strong>New PickUp Request</strong>
                                    </h6>
                                    <a href="{{ route('pickup-management') }}" class="btn btn-sm btn-white mx-3">
                                        <i class="material-icons text-sm me-1">arrow_back</i>
                                        Back to List
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            @if ($errors->any())
                                <div class="alert alert-danger text-white d-flex align-items-center" role="alert">
                                    <i class="material-icons me-2">error</i>
                                    <div>
                                        Please check the form for errors
                                        <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('pickup.store') }}" novalidate class="row g-4">
                                @csrf
                                
                                <div class="col-md-12">
                                    <div class="card shadow-none border">
                                        <div class="card-header bg-light p-3">
                                            <h6 class="mb-0 text-primary">
                                                <i class="material-icons text-primary me-2 align-middle" style="font-size: 20px;">person_outline</i>
                                                Customer & Restaurant Details
                                            </h6>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-static">
                                                        <label class="ms-0 text-uppercase text-xs font-weight-bold">Customer</label>
                                                        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                                            <option value="">Select Customer</option>
                                                            @foreach($users as $user)
                                                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('user_id')
                                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group input-group-static">
                                                        <label class="ms-0 text-uppercase text-xs font-weight-bold">Restaurant</label>
                                                        <select name="restaurant_id" class="form-select @error('restaurant_id') is-invalid @enderror" required>
                                                            <option value="">Select Restaurant</option>
                                                            @foreach($restaurants as $restaurant)
                                                                <option value="{{ $restaurant->id }}" {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>
                                                                    {{ $restaurant->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('restaurant_id')
                                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="card shadow-none border">
                                        <div class="card-header bg-light p-3">
                                            <h6 class="mb-0 text-primary">
                                                <i class="material-icons text-primary me-2 align-middle" style="font-size: 20px;">restaurant_menu</i>
                                                Order Details
                                            </h6>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <div class="input-group input-group-static">
                                                        <label class="ms-0 text-uppercase text-xs font-weight-bold">Food Item</label>
                                                        <select name="food_id" class="form-select @error('food_id') is-invalid @enderror" required>
                                                            <option value="">Select Food</option>
                                                            @foreach($food as $foodd)
                                                                <option value="{{ $foodd->id }}" {{ old('food_id') == $foodd->id ? 'selected' : '' }}>
                                                                    {{ $foodd->food_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('food_id')
                                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="card shadow-none border">
                                        <div class="card-header bg-light p-3">
                                            <h6 class="mb-0 text-primary">
                                                <i class="material-icons text-primary me-2 align-middle" style="font-size: 20px;">delivery_dining</i>
                                                Pickup Details
                                            </h6>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-static">
                                                        <label class="ms-0 text-uppercase text-xs font-weight-bold">Pickup Time</label>
                                                        <input type="datetime-local" 
                                                               name="pickup_time" 
                                                               class="form-control @error('pickup_time') is-invalid @enderror"
                                                               value="{{ old('pickup_time') }}"
                                                               required>
                                                        @error('pickup_time')
                                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group input-group-static">
                                                        <label class="ms-0 text-uppercase text-xs font-weight-bold">Status</label>
                                                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                                                 Pending
                                                            </option>
                                                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>
                                                                Approved
                                                            </option>
                                                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>
                                                                 Rejected
                                                            </option>
                                                        </select>
                                                        @error('status')
                                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="input-group input-group-outline">
                                                        <label class="form-label">Pickup Address</label>
                                                        <input type="text" 
                                                               name="pickup_address" 
                                                               class="form-control @error('pickup_address') is-invalid @enderror"
                                                               value="{{ old('pickup_address') }}"
                                                               required>
                                                        @error('pickup_address')
                                                            <div class="text-danger text-xs mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('pickup-management') }}" class="btn btn-outline-secondary">
                                            <i class="material-icons me-1">cancel</i> Cancel
                                        </a>
                                        <button type="submit" class="btn bg-gradient-primary">
                                            <i class="material-icons me-1">save</i> Create Request
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
    .form-select {
        padding-top: 0.625rem;
        padding-bottom: 0.625rem;
    }
    
    .input-group-static label.ms-0 {
        margin-bottom: 0.5rem;
    }
    
    .card.shadow-none {
        transition: all 0.3s ease;
    }
    
    .card.shadow-none:hover {
        border-color: #e91e63;
    }
    
    .bg-light {
        background-color: #fafafa !important;
    }
    
    .text-uppercase.text-xs {
        letter-spacing: 0.08em;
    }
</style>
    </main>
</x-layout>
