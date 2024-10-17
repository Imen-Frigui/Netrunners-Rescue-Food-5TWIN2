@extends('components.front-office')

@section('content')
 <x-navbars.Navbar activePage='index'></x-navbars.Navbar>
  <x-navbars.navs.auth titlePage="User Interface"></x-navbars.navs.auth> 
<div class="container mt-4">
    <img src="{{ asset('assets/img/donation1.jpg') }}" class="position-absolute w-100 h-100 top-0 start-0" style="object-fit: cover; z-index: -1;" alt="Background Image">
    <h1>Welcome to the Front Office</h1>
    <p>Explore our services and features below.</p>

    <!-- Restaurants Section -->
    <h2>Restaurants</h2>
    <div class="row">
        @foreach ($restaurants as $restaurant)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title">{{ $restaurant->name }}</h3>
                        <p class="card-text">{{ $restaurant->address }}</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Foods Section -->
    <h2>Foods</h2>
    <div class="row">
        @foreach ($foods as $food)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title">{{ $food->food_name }}</h3>
                        <p class="card-text">{{ $food->description }}</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Events Section -->
    <h2>Upcoming Events</h2>
    <div class="row">
        @foreach ($events as $event)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title">{{ $event->title }}</h3>
                        <p class="card-text">{{ $event->description }}</p>
                        <p class="text-muted">Date: {{ $event->date }}</p>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
