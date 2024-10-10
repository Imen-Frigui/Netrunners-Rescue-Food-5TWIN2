<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="reviews"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Edit Review"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <h1>Edit Review</h1>

            <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card p-3 mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user_id">User ID</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="material-icons">person</i>
                                </span>
                                <input type="text" name="user_id" id="user_id" class="form-control" 
                                       value="{{ old('user_id', $review->user_id) }}" 
                                       placeholder="Enter user ID" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="material-icons">comment</i>
                                </span>
                                <textarea name="comment" id="comment" class="form-control" 
                                          placeholder="Enter your comment" required>{{ old('comment', $review->comment) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="material-icons">star</i>
                                </span>
                                <input type="number" name="rating" id="rating" class="form-control" 
                                       value="{{ old('rating', $review->rating) }}" min="1" max="5" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Review</button>
                        <a href="{{ route('reviews') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>

        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>
