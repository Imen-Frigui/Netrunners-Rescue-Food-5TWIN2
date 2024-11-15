<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="reviews"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Reviews"></x-navbars.navs.auth>
        
        <div class="container-fluid py-4">
    <h1>Reviews</h1>
    <a href="{{ route('reviews.create') }}" class="btn btn-primary mb-3">Add New Review</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter by Rating -->
    <form method="GET" action="{{ route('reviews') }}" class="mb-3">
        <label for="rating_filter" class="form-label">Filter by Rating:</label>
        <select id="rating_filter" name="rating" class="form-select" onchange="this.form.submit()">
            <option value="">All Ratings</option>
            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star</option>
            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
        </select>
    </form>

    <!-- Search Form -->
    <form method="GET" action="{{ route('reviews') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search reviews..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    @if ($reviews->isEmpty())
        <p>No reviews available.</p>
    @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Comment</th>
                                <th>Rating</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <td>{{ $review->comment }}</td>
                                    <td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <span class="text-warning">&#9733;</span>
                                            @else
                                                <span class="text-muted">&#9734;</span>
                                            @endif
                                        @endfor
                                    </td>
                                    <td>
                                        <a href="{{ route('reviews.show', $review->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $reviews->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    @endif

    <x-footers.auth></x-footers.auth>
</div>

    </main>
    <x-plugins></x-plugins>
</x-layout> 
