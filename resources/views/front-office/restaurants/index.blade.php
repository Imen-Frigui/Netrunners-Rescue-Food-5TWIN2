<x-layout bodyClass="bg-gray-200">
    <x-navbars.Navbar activePage="restaurants"></x-navbars.Navbar>

    <x-navbars.navs.auth titlePage="User Interface"></x-navbars.navs.auth>

    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
            <img src="{{ asset('assets/img/donation1.jpg') }}" class="position-absolute w-100 h-100 top-0 start-0" style="object-fit: cover; z-index: -1;" alt="Background Image">
            <div class="container mt-4"> <!-- Added mt-4 for top margin -->
                <div class="row justify-content-center">
                    @foreach($restaurants as $restaurant)
                        <div class="col-lg-4 col-md-6 col-12 mt-8 mb-8"> <!-- Added mb-4 for spacing -->
                            <div class="card z-index-0 fadeIn3 fadeInBottom d-flex flex-column" style="height: 100%;"> <!-- Set height to 100% -->
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">{{ $restaurant->name }}</h4>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-grow-1"> <!-- Make card body flex-grow -->
                                    <div class="d-flex flex-column justify-content-between flex-grow-1"> <!-- Ensure vertical spacing -->
                                        <div>
                                            <p class="text-sm">{{ $restaurant->address }}</p>
                                            <p class="text-sm"><strong>Location:</strong> {{ $restaurant->phone }}</p>
                                        </div>
                                        <div class="text-center">
                                            <a href="{{ route('restaurants.front.show', $restaurant->id) }}" class="btn bg-gradient-primary w-100 my-4 mb-2">View Restaurant</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

           
        </div>
    </main>
</x-layout>
