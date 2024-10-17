<!-- resources/views/pickups.blade.php -->

<x-layout bodyClass="bg-gray-200">
<x-navbars.Navbar activePage='index'></x-navbars.Navbar>
<x-navbars.navs.auth titlePage="User Interface"></x-navbars.navs.auth>
    <main class="main-content mt-0">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-12 mt-8 mb-4">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">My Pickup Requests</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="text-primary">Pickup Request Details</h5>
                            @if($pickups->isEmpty())
                                <p>No pickup requests available.</p>
                            @else
                                <ul class="list-group">
                                    @foreach($pickups as $pickup)
                                        <li class="list-group-item">
                                            <h5 class="font-weight-bold">{{ $pickup->food->food_name }} from {{ $pickup->restaurant->name }}</h5>
                                            <p class="mb-1"><strong>Pickup Time:</strong> {{ $pickup->pickup_time}}</p>
                                            <p class="mb-1"><strong>Address:</strong> {{ $pickup->pickup_address }}</p>
                                            <p class="mb-1"><strong>Status:</strong> {{ $pickup->status }}</p>
                                            <p class="text-muted">Requested on: {{ $pickup->request_time }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-footers.guest></x-footers.guest>
</x-layout>