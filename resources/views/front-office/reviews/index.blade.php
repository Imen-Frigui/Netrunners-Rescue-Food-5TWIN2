@extends('components.front-office')

@section('content')
<x-navbars.Navbar activePage='reviews'></x-navbars.Navbar>

<div class="container mt-8">
    <h1>My Reviews</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('myreviewcreate') }}" class="btn btn-primary mb-3">Add New Review</a>

    <!-- Filter and Search Form -->
    <form method="GET" action="{{ route('myreviews') }}" class="mb-3 d-flex">
        <select name="rating" class="form-select me-2" onchange="this.form.submit()">
            <option value="">All Ratings</option>
            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star</option>
            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
        </select>

        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search reviews..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    @if($reviews->isEmpty())
        <p>You have not submitted any reviews.</p>
    @else
        <ul class="list-group">
            @foreach($reviews as $review)
                <li class="list-group-item">
                    <h5>Rating:</h5>
                    <td>
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <span class="text-warning">&#9733;</span>
                            @else
                                <span class="text-muted">&#9734;</span>
                            @endif
                        @endfor
                    </td>
                    <p>{{ $review->comment }}</p>
                    <a href="{{ route('myreview', $review->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('myreviewedit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('myreviewdelete', $review->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $reviews->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
