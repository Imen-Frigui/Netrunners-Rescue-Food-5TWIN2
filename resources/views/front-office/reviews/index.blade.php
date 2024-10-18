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

        @if($reviews->isEmpty())
            <p>You have not submitted any reviews.</p>
        @else
            <ul class="list-group">
                @foreach($reviews as $review)
                    <li class="list-group-item">
                        <h5>Rating: {{ $review->rating }}</h5>
                        <p>{{ $review->comment }}</p>
                        <a href="{{ route('reviews.show', $review->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('myreviewedit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection