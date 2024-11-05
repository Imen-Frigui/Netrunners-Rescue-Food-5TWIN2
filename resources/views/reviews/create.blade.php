<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="reviews"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Create Review"></x-navbars.navs.auth>
        
        <div class="container-fluid py-4">
            <h1>Create New Review</h1>
            
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf



                

                <div class="form-group">
                    <label for="phone">Comment</label>
                    <input type="text" name="comment" id="comment" class="form-control" required>
                </div>

                <div class="form-group">
    <label for="rating">Rating</label>
    <div id="star-rating">
        <!-- Render 5 stars, each with a unique ID and click handler -->
        @for ($i = 1; $i <= 5; $i++)
            <span class="star text-muted" data-value="{{ $i }}" onclick="setRating({{ $i }})">
                &#9734; <!-- Empty star initially -->
            </span>
        @endfor
    </div>
    <!-- Hidden input to store the selected rating -->
    <input type="hidden" name="rating" id="rating" required>
</div>

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


               

                

                <button type="submit" class="btn btn-primary mt-3">Create Review</button>
                <a href="{{ route('reviews') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>

        <x-footers.auth></x-footers.auth>
    </main>
   

   
    
</x-layout>