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
                    <label for="email">Rating</label>
                    <input type="text" name="rating" id="rating" class="form-control" required>
                </div>

               

                

                <button type="submit" class="btn btn-primary mt-3">Create Review</button>
                <a href="{{ route('reviews') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>

        <x-footers.auth></x-footers.auth>
    </main>
   

   
    
</x-layout>