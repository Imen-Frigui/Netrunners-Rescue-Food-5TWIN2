@extends('components.front-office')

@section('content')
<x-navbars.Navbar activePage='reviews'></x-navbars.Navbar>

<div class="container mt-10">
    <h1 class="text-center mb-4">Leave a Review</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('myreviewstore') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="restaurant_id" class="font-weight-bold">Select Restaurant:</label>
                    <select name="restaurant_id" id="restaurant_id" class="form-control" required>
                        <option value="" disabled selected>Select a restaurant</option>
                        @foreach($restaurants as $restaurant)
                            <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="rating" class="font-weight-bold">Rating (1-5):</label>
                    <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
                </div>

                <div class="form-group">
                    <label for="comment" class="font-weight-bold">Comment:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="5" placeholder="Share your thoughts..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Submit Review</button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Custom styles for the form */
    .container {
        max-width: 600px;
    }
    .card {
        border: none;
        border-radius: 10px;
    }
    .card-body {
        padding: 2rem;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s, border-color 0.3s;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>

@endsection