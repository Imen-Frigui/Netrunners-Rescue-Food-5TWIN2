<!-- resources/views/restaurants/show.blade.php -->
<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="restaurants"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="View Restaurant"></x-navbars.navs.auth>
        
        <div class="container-fluid py-4">
            <h1>{{ $restaurant->name }}</h1>
            <p><strong>Address:</strong> {{ $restaurant->address }}</p>
            <p><strong>Phone:</strong> {{ $restaurant->phone }}</p>
            
            <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('restaurants') }}" class="btn btn-secondary">Back to Restaurants</a>
        </div>
        
        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>
