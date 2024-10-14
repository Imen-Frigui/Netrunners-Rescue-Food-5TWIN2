@extends('components.front-office')

@section('content')
<x-navbars.frontsidebar activePage='Dashboard'></x-navbars.sidebar>

<x-navbars.navs.auth titlePage="user Interface"></x-navbars.navs.auth>

    <div class="container">
        <h1>Welcome to the Front Office</h1>
        <p>Explore our services and features below.</p>

        <!-- Restaurants Section -->
        <h2>Restaurants</h2>
        <div class="restaurants-list">
            @foreach ($restaurants as $restaurant)
                <div class="restaurant-item">
                    <h3>{{ $restaurant->name }}</h3>
                    <p>{{ $restaurant->description }}</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            @endforeach
        </div>

        <!-- Foods Section -->
        <h2>Foods</h2>
        <div class="foods-list">
            @foreach ($foods as $food)
                <div class="food-item">
                    <h3>{{ $food->name }}</h3>
                    <p>{{ $food->description }}</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            @endforeach
        </div>

        <!-- Pickups Section -->
       

        <!-- Events Section -->
        <h2>Upcoming Events</h2>
        <div class="events-list">
            @foreach ($events as $event)
                <div class="event-item">
                    <h3>{{ $event->title }}</h3>
                    <p>{{ $event->description }}</p>
                    <p>Date: {{ $event->date }}</p>
                    <a href="{{ route('front-office.events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
