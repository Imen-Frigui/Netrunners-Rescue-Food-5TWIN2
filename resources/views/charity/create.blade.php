<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Add New Report"></x-navbars.navs.auth>
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
                        <h6 class="text-white text-capitalize ps-3">Add New Report for {{ $charity->charity_name }}</h6>
                    </div>
                </div>
                <div class="card-body px-4 py-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Report Information</h5>
                        <a href="{{ route('charities') }}" class="btn bg-gradient-dark">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Report Form -->
                    <form action="{{ route('reports.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="charity_id" value="{{ $charity->id }}"> <!-- Hidden input for charity_id -->

                        <div class="mb-3">
                            <label for="report_type" class="form-label">Report Type</label>
                            <select class="form-control border border-2 p-2 @error('report_type') is-invalid @enderror" id="report_type" name="report_type" required>
                                <option value="" disabled selected>Select a Report Type</option>
                                <option value="financial" {{ old('report_type') == 'financial' ? 'selected' : '' }}>Financial</option>
                                <option value="performance" {{ old('report_type') == 'performance' ? 'selected' : '' }}>Performance</option>
                                <option value="event summary" {{ old('report_type') == 'event summary' ? 'selected' : '' }}>Event Summary</option>
                                <option value="volunteer report" {{ old('report_type') == 'volunteer report' ? 'selected' : '' }}>Volunteer Report</option>
                            </select>
                            @error('report_type') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control border border-2 p-2 @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                            @error('content') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="report_date" class="form-label">Report Date</label>
                            <input type="date" class="form-control border border-2 p-2 @error('report_date') is-invalid @enderror" id="report_date" name="report_date" value="{{ old('report_date') }}" required>
                            @error('report_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn bg-gradient-dark">Create Report</button>
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
