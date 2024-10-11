<x-layout bodyClass="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-navbars.navs.guest signin='static-sign-in' signup='static-sign-up'></x-navbars.navs.guest>
            </div>
        </div>
    </div>

    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
            <img src="{{ asset('assets/img/donation2.jpg') }}" class="position-absolute w-100 h-100 top-0 start-0" style="object-fit: cover; z-index: -1;" alt="Background Image">

            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-10 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header">
                                <h5 class="text-info text-center animated-title">{{ $food->food_name }}</h5>
                            </div>
                            <div class="card-body text-center">
                                <p><strong>Category:</strong> {{ ucfirst($food->category) }}</p>
                                <p><strong>Status:</strong> {{ ucfirst($food->status) }}</p>
                                <p><strong>storage_conditions:</strong> {{ $food->storage_conditions }} </p>
                                @if($food->donation_date)
                                <p><strong>Donation Date:</strong> {{ \Carbon\Carbon::parse($food->donation_date)->format('d M Y') }}</p>
                                @endif
                                <div class="card-footer text-center">
                                    <a href="{{ route('donations') }}" class="btn btn-info">
                                        <i class="fas fa-arrow-left"></i> &nbsp;&nbsp; Back to Donations Page
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <x-footers.guest></x-footers.guest>
        </div>
    </main>
</x-layout>

<style>
    @keyframes slideIn {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .animated-title {
        animation: slideIn 1s ease-out;
    }
</style>