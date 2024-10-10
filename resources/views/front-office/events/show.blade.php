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
                                <p><strong>Status:</strong> {{ $event->enabled ? 'Enabled' : 'Disabled' }}</p>
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
