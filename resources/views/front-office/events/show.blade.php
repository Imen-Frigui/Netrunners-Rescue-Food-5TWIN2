<x-layout bodyClass="bg-gray-200">

    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
    </div>
    <x-navbars.Navbar activePage="showEvent"></x-navbars.Navbar>

<x-navbars.navs.auth titlePage="user Interface"></x-navbars.navs.auth>
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
                        <img src="{{ asset('assets/img/event2.jpg') }}" class="position-absolute w-100 h-100 top-0 start-0" style="object-fit: cover; z-index: -1;" alt="Background Image">

            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-8 col-md-10 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header">
                                <h5 class="text-primary">{{ $event->name }}</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Description:</strong> {{ $event->description }}</p>
                                <p><strong>Location:</strong> {{ $event->location }}</p>
                                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, H:i') }}</p>
                                <p><strong>Max Participants:</strong> {{ $event->max_participants }}</p>
                                <p><strong>Status:</strong>
                                    <span class="badge
                                        @if($event->status === 'Upcoming') bg-success
                                        @elseif($event->status === 'Ongoing') bg-warning
                                        @else bg-danger @endif">
                                        {{ $event->status }}
                                    </span>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('events.all') }}" class="btn btn-secondary">Back to Events</a>
                                <!-- Optionally, you can add a button to register for the event -->
                                {{-- <a href="{{ route('events.register', $event->id) }}" class="btn btn-primary">Register</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.guest></x-footers.guest>
        </div>
    </main>
</x-layout>
