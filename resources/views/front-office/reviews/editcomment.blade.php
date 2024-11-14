<x-layout bodyClass="g-sidenav-show bg-gray-200">

@extends('components.front-office')

@section('content')
<x-navbars.Navbar activePage='reviews'></x-navbars.Navbar>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Edit Comment"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <h1>Edit Comment</h1>

            <div class="card p-3">
                <div class="card-body">
                    <form action="{{ route('updatefront', $comment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="comment_body" class="form-label">Comment</label>
                            <textarea id="comment_body" name="comment_body" class="form-control" required>{{ $comment->comment_body }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Comment</button>
                        <a href="{{ route('myreview', $comment->review_id) }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>
