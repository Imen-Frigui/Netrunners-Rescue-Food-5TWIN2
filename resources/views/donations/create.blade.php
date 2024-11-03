<x-layout bodyClass="bg-gray-200">
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
            <img src="{{ asset('assets/img/donation1.jpg') }}" class="position-absolute w-100 h-100 top-0 start-0" style="object-fit: cover; z-index: -1;" alt="Background Image">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row text-center mb-2">
                    <div class="col-12">
                        <h2 class="text-white font-weight-bold">Make a Donation</h2>
                        <p class="text-white">Your donation can make a difference. Fill out the form below to donate food items.</p>
                    </div>
                </div>

                <div class="position-fixed start-0 top-50 translate-middle-y ms-5 z-index-3">
                    <a href="{{ route('donations') }}" class="btn btn-outline-light d-flex align-items-center">
                        <i class="fas fa-arrow-left me-2"></i> Back to Donations List
                    </a>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Donation Form</h4>
                            </div>
                            <div class="card-body mb-4">
                                <form action="{{ route('donations.store') }}" method="POST">
                                    @csrf
                                    <div class="input-group input-group-outline ">
                                        <select name="donor_type" class="form-control @error('donor_type') is-invalid @enderror">
                                            <option value="">Select Donor Type</option>
                                            <option value="Restaurant" {{ old('donor_type') == 'Restaurant' ? 'selected' : '' }}>Restaurant</option>
                                            <option value="Individual" {{ old('donor_type') == 'Individual' ? 'selected' : '' }}>Individual</option>
                                            <option value="Charity" {{ old('donor_type') == 'Charity' ? 'selected' : '' }}>Charity</option>
                                        </select>
                                        @error('donor_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Quantity Input -->
                                    <div class="input-group input-group-outline mt-3">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}">
                                        @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Remarks Input -->
                                    <div class="input-group input-group-outline mt-3">
                                        <textarea name="remarks" class="form-control @error('remarks') is-invalid @enderror" placeholder="Add your remarks here...">{{ old('remarks') }}</textarea>
                                        @error('remarks')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Select Foods Input -->
                                    <div class="input-group input-group-outline mt-3">
                                        <select name="food_id" class="form-control @error('food_id') is-invalid @enderror">
                                            <option value="">Select Food</option>
                                            @foreach ($foods as $food)
                                            <option value="{{ $food->id }}" {{ old('food_id') == $food->id ? 'selected' : '' }}>{{ $food->food_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('food_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="input-group input-group-outline mt-3">
                                        <select name="beneficiary_id" class="form-control @error('beneficiary_id') is-invalid @enderror">
                                            <option value="">Select Beneficiary</option>
                                            @foreach ($beneficiaries as $beneficiary)
                                            <option value="{{ $beneficiary->id }}" {{ old('beneficiary_id') == $beneficiary->id ? 'selected' : '' }}>
                                                {{ $beneficiary->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('beneficiary_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <!-- Submit Button -->
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn bg-gradient-success w-100">Submit Donation</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @if(session('success'))
    <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 9999;">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var successToast = document.getElementById('successToast');
            if (successToast) {
                var toast = new bootstrap.Toast(successToast);
                toast.show();
            }
        });
    </script>
</x-layout>
