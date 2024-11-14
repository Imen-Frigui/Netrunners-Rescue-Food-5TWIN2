<x-layout bodyClass="g-sidenav-show bg-gray-200">

@extends('components.front-office')

@section('content')
<x-navbars.Navbar activePage='reviews'></x-navbars.Navbar>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Edit Review"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <h1>Edit Review</h1>

            <form action="{{ route('updatemyreviews', $review->id) }}" method="POST">
                @csrf
                @method('POST')

                <div class="card p-3 mb-4">
                    <div class="card-body">
                       

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
    <div id="star-rating">
        <!-- Render 5 stars with click event, highlighting based on current rating -->
        @for ($i = 1; $i <= 5; $i++)
            <span class="star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}" 
                  data-value="{{ $i }}" onclick="setRating({{ $i }})">
                &#9733;
            </span>
        @endfor
    </div>
    <!-- Hidden input to store the selected rating -->
    <input type="hidden" name="rating" id="rating" value="{{ old('rating', $review->rating) }}" required>
</div>

<script>
    // Set initial rating based on the current value in the input
    document.addEventListener('DOMContentLoaded', function() {
        setRating({{ $review->rating }});
    });

    function setRating(rating) {
        // Update stars based on selected rating
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
        // Set hidden input value to selected rating
        document.getElementById('rating').value = rating;
    }
</script>

<style>
    #star-rating .star {
        font-size: 1.5em; /* Adjust size as needed */
        cursor: pointer;
    }
</style>


                        <button type="submit" class="btn btn-primary">Update Review</button>
                        <a href="{{ route('myreviews') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>

        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>
