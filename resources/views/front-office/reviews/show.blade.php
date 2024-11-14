@extends('components.front-office')

@section('content')
<x-navbars.Navbar activePage='reviews'></x-navbars.Navbar>

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

                    <a href="{{ route('myreviews') }}" class="btn btn-secondary">Back to Reviews</a>
                    <a href="{{ route('myreviewedit', $review->id) }}" class="btn btn-sm btn-warning">Edit Review</a> 
                    </div>
            </div>

            <div class="card p-3 mb-4">
    <div class="card-body">
        <h2>Comments</h2>

        <!-- Display existing comments -->
        @if($comments->isEmpty())
            <p>No comments yet.</p>
        @else
            @foreach ($comments as $comment)
                <div class="mb-3 border-bottom pb-2">
                    <p><strong>{{ $comment->user->name ?? 'Anonymous' }}:</strong> {{ $comment->comment_body }}</p>
                    <div class="comment">
        <!-- <p>{{ $comment->comment_body }}</p> -->
        @if ($comment->image_path)
        @if ($comment->image_path)
    <img src="{{ Storage::url($comment->image_path) }}" alt="Comment Image" class="img-fluid" style="max-width: 200px; height: auto;"> 
@endif
        @endif
        <p class="text-muted">{{ $comment->created_at->diffForHumans() }}</p>

    </div>
                    <!-- Edit and Delete Buttons (only visible to comment owner) -->
                    @if(Auth::id() === $comment->user_id)
                        <div>
                            <a href="{{ route('editfront', $comment->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach

            <!-- Pagination links -->
            <div class="mt-3">
                {{ $comments->links('pagination::bootstrap-4') }} <!-- This will generate the pagination links -->
            </div>
        @endif

        <!-- Add a new comment -->
        <h3>Add a Comment</h3>
<form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data"> <!-- Add enctype -->
    @csrf
    <input type="hidden" name="review_id" value="{{ $review->id }}">
    
    <div class="mb-3">
        <label for="comment_body" class="form-label">Comment</label>
        <textarea id="comment_body" name="comment_body" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Upload Image</label>
        <input type="file" id="image" name="image" class="form-control" accept="image/*"> <!-- Add file input -->
    </div>
    
    <button type="submit" class="btn btn-success">Submit Comment</button>
</form>

    </div>
</div>


            
        </div>

        <x-footers.auth></x-footers.auth>
    </main>


@endsection