<x-layout bodyClass="bg-gray-200">
    <x-navbars.Navbar activePage="restaurants"></x-navbars.Navbar>

    <x-navbars.navs.auth titlePage="Restaurant Details"></x-navbars.navs.auth>

    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-12 mb-4"> <!-- Centered content -->
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">{{ $restaurant->name }}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="text-primary">Restaurant Information</h5>
                                <p><strong>Address:</strong> {{ $restaurant->address }}</p>
                                <p><strong>Phone:</strong> {{ $restaurant->phone }}</p>
                                <!-- Add more details as needed -->

                                <div class="text-center mt-4">
                                    <a href="{{ route('restaurants.all') }}" class="btn bg-gradient-primary w-100 mb-2">Back to All Restaurants</a>
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