<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="restaurants"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Restaurants"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <h1>Restaurants</h1>
            <a href="{{ route('restaurants.create') }}" class="btn btn-success mb-3">Add New Restaurant</a>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" action="{{ route('restaurants') }}" class="mb-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, address, or phone" class="form-control" style="width: 300px; display: inline-block;">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            @if ($restaurants->isEmpty())
                <p>No restaurants available.</p>
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($restaurants as $restaurant)
                                        <tr>
                                            <td>{{ $restaurant->name }}</td>
                                            <td>{{ $restaurant->address }}</td>
                                            <td>{{ $restaurant->phone }}</td>
                                            <td>
                                                <a href="{{ route('restaurants.show', $restaurant->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('inventories.indexResto', ['restaurant' => $restaurant->id]) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-box"></i> View Inventory
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $restaurant->id }})">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Links (only once) -->
                        <div class="d-flex justify-content-center">
                            {{ $restaurants->links('pagination::bootstrap-4') }} 
                        </div>
                    </div>
                </div>
            @endif

            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this restaurant?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle delete confirmation -->
    <script>
    function confirmDelete(restaurantId) {
        // Update the form action with the restaurant ID
        const form = document.getElementById('deleteForm');
        form.action = `/restaurants/${restaurantId}`;

        // Show the modal using vanilla JavaScript
        const deleteModal = document.getElementById('deleteModal');
        const modal = new bootstrap.Modal(deleteModal);
        modal.show();
    }
</script>

</x-layout>
