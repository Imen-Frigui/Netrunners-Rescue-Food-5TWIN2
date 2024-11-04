<x-layout bodyClass="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
    </div>
    <x-navbars.Navbar activePage="showEvent"></x-navbars.Navbar>

    <x-navbars.navs.auth titlePage="User Interface"></x-navbars.navs.auth>
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
            <img src="{{ asset('assets/img/event2.jpg') }}" class="position-absolute w-100 h-100 top-0 start-0" style="object-fit: cover; z-index: -1;" alt="Background Image">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12 d-flex">
                        <!-- Main Event Card -->
                        <div class="card z-index-0 fadeIn3 fadeInBottom flex-grow-1 me-4">
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
                                <p><strong>Total Sponsorship Amount:</strong> ${{ $event->sponsors->sum('pivot.sponsorship_amount') }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('events.all') }}" class="btn btn-secondary">Back to Events</a>
                            </div>
                        </div>

                        <!-- Sponsor List Section -->
                        <div class="card z-index-0 fadeIn3 fadeInBottom" style="width: 400px;">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0 text-white">Sponsors</h6>
                            </div>
                            <div class="card-body p-2">
                                <ul class="list-group list-group-flush">
                                    @foreach($event->sponsors as $sponsor)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('sponsors.show', $sponsor->id) }}" class="text-decoration-none">
                                                {{ $sponsor->name }}
                                            </a>
                                            <span class="badge rounded-pill">
                                                @if(strtolower($sponsor->pivot->sponsorship_level) === 'gold')
                                                    <img src="{{ asset('assets/img/gold_badge.png') }}" alt="Gold Badge" width="40">
                                                @elseif(strtolower($sponsor->pivot->sponsorship_level) === 'silver')
                                                    <img src="{{ asset('assets/img/silver_badge.png') }}" alt="Silver Badge" width="40">
                                                @elseif(strtolower($sponsor->pivot->sponsorship_level) === 'platinum')
                                                    <img src="{{ asset('assets/img/platinum_badge.png') }}" alt="Platinum Badge" width="40">
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.guest></x-footers.guest>
        </div>
    </main>
</x-layout>
