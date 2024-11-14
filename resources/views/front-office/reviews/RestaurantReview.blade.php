@extends('components.front-office')

@section('content')
<x-navbars.Navbar activePage='reviews'></x-navbars.Navbar>

<div class="container mt-10">
    <img src="{{ asset('assets/img/donation1.jpg') }}" class="position-absolute w-100 h-100 top-0 start-0" style="object-fit: cover; z-index: -1;" alt="Background Image">

    <h1 class="text-center mb-4 text-white">Leave a Review for {{ $restaurant->name }}:</h1>

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
            <form action="{{ route('myreviewstoreResto' ,['restaurantId' => $restaurant->id]) }}" method="POST">
                @csrf

                <!-- Hidden field to store restaurant ID -->
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

                <div class="form-group">
    <label for="rating" class="font-weight-bold">Rating:</label>
    <div id="star-rating">
        <!-- Render 5 stars, each with a unique data-value attribute and click handler -->
        @for ($i = 1; $i <= 5; $i++)
            <span class="star text-muted" data-value="{{ $i }}" onclick="setRating({{ $i }})">
                &#9734; <!-- Empty star initially -->
            </span>
        @endfor
    </div>
    <!-- Hidden input to store the selected rating -->
    <input type="hidden" name="rating" id="rating" required>
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
<script>
    // JavaScript to handle star click and display selected rating
    function setRating(rating) {
        // Update all stars to show filled or empty based on selected rating
        for (let i = 1; i <= 5; i++) {
            const star = document.querySelector(`.star[data-value="${i}"]`);
            if (i <= rating) {
                star.classList.remove('text-muted');
                star.classList.add('text-warning'); // Filled star
                star.innerHTML = '&#9733;'; // Filled star symbol
            } else {
                star.classList.remove('text-warning');
                star.classList.add('text-muted'); // Empty star
                star.innerHTML = '&#9734;'; // Empty star symbol
            }
        }
        // Set the hidden input value to the selected rating
        document.getElementById('rating').value = rating;
    }
</script>

<style>
    #star-rating .star {
        font-size: 1.5em; /* Adjust size as needed */
        cursor: pointer;
    }
</style>

@endsection
