<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="restaurants"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="{{ $restaurant->name }} Inventory"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <h1>Inventory for {{ $restaurant->name }}</h1>
            <a href="{{ route('inventories.createResto', ['restaurant' => $restaurant->id]) }}" class="btn btn-success mt-3">Add New Inventory Item</a>

           
            <form method="GET" action="{{ route('inventories.indexResto', $restaurant->id) }}" class="mt-3 mb-3">
    <div class="input-group">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search food items..." aria-label="Search food items">
        <button class="btn btn-outline-secondary btn-sm" type="submit">Search</button>
    </div>
</form>

<table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Food Item</th>
                        <th>Quantity on Hand</th>
                        <th>Minimum Quantity</th>
                        <th>Storage Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->food->food_name }}</td>
                            <td>{{ $inventory->quantity_on_hand }}</td>
                            <td>{{ $inventory->minimum_quantity }}</td>
                            <td>{{ $inventory->storage_location }}</td>
                            <td>
                                <a href="{{ route('inventories.editResto', ['restaurant' => $restaurant->id, 'inventory' => $inventory->id]) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('inventories.destroyResto', ['restaurant' => $restaurant->id, 'inventory' => $inventory->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-between">
                <div>
                    {{ $inventories->links() }} <!-- Pagination Links -->
                </div>
                <div>
                    <p>Total Items: {{ $inventories->total() }}</p> <!-- Total count of items -->
                </div>
            </div>
        </div>

        <x-footers.auth></x-footers.auth>
    </main>

    <x-plugins></x-plugins>
</x-layout>
<style>
    .custom-border {
    border: 1px solid #007bff; /* Example color */
    border-radius: .25rem; /* Adjust radius as needed */
}

.custom-border:focus {
    border-color: #0056b3; /* Change border color on focus */
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25); /* Optional shadow effect */
}

</style>