<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="reviews"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Review Details"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <h1>Review Details</h1>

            <div class="card p-3 mb-4">
                <div class="card-body">
                    <p><strong>Review:</strong> {{ $review->comment }}</p>

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

            <!-- Comments Section -->
            <div class="card p-3 mb-4">
                <div class="card-body">
                    <h2>Comments</h2>

                    <!-- Display existing comments -->
                    @if($review->comments->isEmpty())
                        <p>No comments yet.</p>
                    @else
                        @foreach ($review->comments as $comment)
                            <div class="mb-3 border-bottom pb-2">
                                <p><strong>{{ $comment->user->name ?? 'Anonymous' }}:</strong> {{ $comment->comment_body }}</p>
                                <p class="text-muted">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @endif

                    <!-- Add a new comment -->
                    <h3>Add a Comment</h3>
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="review_id" value="{{ $review->id }}">
                        
                        <div class="mb-3">
                            <label for="comment_body" class="form-label">Comment</label>
                            <textarea id="comment_body" name="comment_body" class="form-control" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Submit Comment</button>
                    </form>
                </div>
            </div>
        </div>

        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>
