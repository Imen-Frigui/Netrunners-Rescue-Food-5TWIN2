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
                                <h6 class="text-white mx-3"><strong>Add New PickUp Request</strong></h6>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('pickup.store') }}">
                                @csrf

                                <!-- Customer Selection -->
                                <div class="form-group mb-3">
                                    <label for="user_id" class="form-label">Customer</label>
                                    <select name="user_id" class="form-select" aria-label="Select Customer">
                                        <option selected disabled>Select Customer</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Restaurant Selection -->
                                <div class="form-group mb-3">
                                    <label for="restaurant_id" class="form-label">Restaurant</label>
                                    <select name="restaurant_id" class="form-select" aria-label="Select Restaurant">
                                        <option selected disabled>Select Restaurant</option>
                                        @foreach($restaurants as $restaurant)
                                            <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Food Selection -->
                                <div class="form-group mb-3">
                                    <label for="food_id" class="form-label">Food</label>
                                    <select name="food_id" class="form-select" aria-label="Select Food">
                                        <option selected disabled>Select Food</option>
                                        @foreach($food as $foodd)
                                            <option value="{{ $foodd->id }}">{{ $foodd->food_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- PickUp Time -->
                                <div class="form-group mb-3">
                                    <label for="pickup_time" class="form-label">PickUp Time</label>
                                    <input type="datetime-local" name="pickup_time" class="form-control" value="{{ old('pickup_time') }}">
                                </div>

                                <!-- PickUp Address -->
                                <div class="form-group mb-3">
                                    <label for="pickup_address" class="form-label">PickUp Address</label>
                                    <input type="text" name="pickup_address" class="form-control" placeholder="Enter address" value="{{ old('pickup_address') }}">
                                </div>

                                <!-- Status Selection -->
                                <div class="form-group mb-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn bg-gradient-dark mb-0">Add PickUp Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
