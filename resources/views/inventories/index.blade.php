<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="inventories"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Inventories"></x-navbars.navs.auth>
        
        <div class="container-fluid py-4">
            <h1>Inventory</h1>
            <a href="{{ route('inventories.create') }}" class="btn btn-success mb-3">Add New Inventory Item</a>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($inventories->isEmpty())
                <p>No inventory items available.</p>
            @else
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Food</th>
                                    <th>Restaurant</th>
                                    <th>Quantity</th>
                                    <th>Minimum Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->food->food_name }}</td>
                                        <td>{{ $inventory->restaurant->name }}</td>
                                        <td>{{ $inventory->quantity_on_hand }}</td>
                                        <td>{{ $inventory->minimum_quantity }}</td>
                                        <td>
                                            <a href="{{ route('inventories.show', $inventory->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
