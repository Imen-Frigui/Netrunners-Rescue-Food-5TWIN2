<x-layout bodyClass="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
    </div>
    <x-navbars.Navbar activePage="showSponsor"></x-navbars.Navbar>

    <x-navbars.navs.auth titlePage="User Interface"></x-navbars.navs.auth>
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100">
            <img src="{{ asset('assets/img/event2.jpg') }}" class="position-absolute w-100 h-100 top-0 start-0" style="object-fit: cover; z-index: -1;" alt="Background Image">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12 d-flex">
                        <!-- Main Sponsor Card -->
                        <div class="card z-index-0 fadeIn3 fadeInBottom flex-grow-1 me-4">
                            <div class="card-header">
                                <h5 class="text-primary">{{ $sponsor->name }}</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Email:</strong> {{ $sponsor->email }}</p>
                                <p><strong>Phone:</strong> {{ $sponsor->phone }}</p>
                                <p><strong>Company:</strong> {{ $sponsor->company }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('sponsors.index') }}" class="btn btn-secondary">Back to Sponsors</a>
                            </div>
                        </div>

                        <!-- Sponsored Events Section -->
                        <div class="card z-index-0 fadeIn3 fadeInBottom" style="width: 400px;">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0 text-white">Sponsored Events</h6>
                            </div>
                            <div class="card-body p-2">
                                <ul class="list-group list-group-flush">
                                    @foreach($sponsor->events as $event)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none">
                                                    {{ $event->name }} - ${{ $event->pivot->sponsorship_amount }}
                                                </a>
                                                <!-- Trigger modal for QR code -->
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#qrCodeModal-{{ $event->id }}">
                                                    <i class="fa fa-qrcode"></i> Generate QR Code
                                                </button>
                                            </div>
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

    <!-- QR Code Modal -->
    @foreach($sponsor->events as $event)
    <div class="modal fade" id="qrCodeModal-{{ $event->id }}" tabindex="-1" aria-labelledby="qrCodeModalLabel-{{ $event->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrCodeModalLabel-{{ $event->id }}">QR Code for {{ $event->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    {!! QrCode::size(200)->generate(route('sponsors.scan', ['sponsor' => $sponsor->id, 'eventId' => $event->id])) !!}
                    <p>Scan this QR code to visit the sponsor's event page.</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-layout>
