<!-- resources/views/restaurants/index.blade.php -->
<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="restaurants"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Restaurants"></x-navbars.navs.auth>
        <!-- End Navbar -->
        
        <div class="container-fluid py-4">
            <h1>Restaurants</h1>
            <a href="{{ route('restaurants.create') }}" class="btn btn-primary mb-3">Add New Restaurant</a>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($restaurants->isEmpty())
                <p>No restaurants available.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($restaurants as $restaurant)
                            <tr>
                                <td>{{ $restaurant->id }}</td>
                                <td>{{ $restaurant->name }}</td>
                                <td>{{ $restaurant->address }}</td>
                                <td>{{ $restaurant->phone }}</td>
                                <td>
                                    <a href="{{ route('restaurants.show', $restaurant->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
