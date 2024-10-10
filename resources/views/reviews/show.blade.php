<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="reviews"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Review Details"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <h1>Review Details</h1>

            <div class="card p-3 mb-4">
                <div class="card-body">
                    <p><strong>Comment:</strong> {{ $review->comment }}</p>

                    <p><strong>Rating:</strong> 
                        <!-- Display stars instead of rating number -->
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <span class="text-warning">&#9733;</span> <!-- Filled star -->
                            @else
                                <span class="text-muted">&#9734;</span> <!-- Empty star -->
                            @endif
                        @endfor
                    </p>

                    <a href="{{ route('reviews') }}" class="btn btn-secondary">Back to Reviews</a>
                    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-primary">Edit Review</a>
                </div>
            </div>
        </div>

        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>
