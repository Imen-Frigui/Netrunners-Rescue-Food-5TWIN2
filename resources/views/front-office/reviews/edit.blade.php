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
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="material-icons">star</i>
                                </span>
                                <input type="number" name="rating" id="rating" class="form-control" 
                                       value="{{ old('rating', $review->rating) }}" min="1" max="5" required>
                            </div>
                        </div>

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
