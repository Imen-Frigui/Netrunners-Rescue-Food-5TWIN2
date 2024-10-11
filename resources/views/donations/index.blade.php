<x-layout bodyClass="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <x-navbars.navs.guest signin='static-sign-in' signup='static-sign-up'></x-navbars.navs.guest>
            </div>
        </div>
    </div>
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
            <img src="{{ asset('assets/img/donation1.jpg') }}" class="position-absolute w-100 h-100 top-0 start-0" style="object-fit: cover; z-index: -1;" alt="Background Image">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <!-- Add your message here -->
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="text-white font-weight-bold">Donated Food Items Near Expiration</h2>
                        <p class="text-white">Help reduce food waste by donating or claiming food items that are nearing their expiration date.</p>
                    </div>
                </div>
                <div class="row">
                    <!-- Loop through the food items -->
                    @foreach($foods as $food)
                    <div class="col-lg-4 col-md-6 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0 bounce-title">{{ $food->food_name }}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-sm"><strong>Quantity:</strong> {{ $food->quantity }} {{ $food->unit }}</p>
                                <p class="text-sm"><strong>Expiration Date:</strong> {{ \Carbon\Carbon::parse($food->expiration_date)->format('F j, Y') }}</p>
                                <p class="text-sm"><strong>Status:</strong> {{ ucfirst($food->status) }}</p>
                                <div class="text-center">
                                    <a href="{{ route('donations.show', $food->id) }}" class="btn bg-gradient-success w-100 my-4 mb-2">
                                        <i class="fas fa-eye"></i>&nbsp;&nbsp; View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <x-footers.guest></x-footers.guest>
        </div>
    </main>
</x-layout>

<style>
    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-20px);
        }

        60% {
            transform: translateY(-10px);
        }
    }

    .bounce-title {
        animation: bounce 2s infinite;
    }
</style>