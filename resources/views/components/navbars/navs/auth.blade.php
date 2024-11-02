<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $titlePage }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">{{ $titlePage }}</h6>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                    <label class="form-label">Type here...</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                @csrf
            </form>
            <ul class="navbar-nav justify-content-end">
                            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                        <span id="notificationBadge" class="badge bg-danger" style="display: none;">!</span> <!-- Notification badge -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li>
                            <h6 class="dropdown-header">Low Stock Items</h6>
                        </li>
                        <!-- Placeholder for low stock items -->
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Low Stock Modal -->
<div class="modal fade" id="lowStockModal" tabindex="-1" aria-labelledby="lowStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lowStockModalLabel">Low Stock Items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="lowStockItems">
                <!-- Low stock items will be appended here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('dropdownMenuButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default action
        fetchLowStockItems();
    });

    function fetchLowStockItems() {
    fetch('{{ route('api.inventories.lowStock') }}')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const lowStockItemsDiv = document.getElementById('lowStockItems');
            lowStockItemsDiv.innerHTML = ''; // Clear previous items

            // Access the notification badge
            const notificationBadge = document.getElementById('notificationBadge');

            // Directly use data since it returns an array
            if (Array.isArray(data) && data.length > 0) {
                // Show the notification badge
                notificationBadge.style.display = 'inline-block';

                data.forEach(item => {
                    lowStockItemsDiv.innerHTML += `
                        <div class="d-flex justify-content-between">
                            <span class="text-sm">
                                ${item.restaurant.name} - ${item.food.food_name} (Quantity on hand: ${item.quantity_on_hand})
                            </span>
                            <span class="text-xs text-danger">${item.minimum_quantity} minimum</span>
                        </div>`;
                });
            } else {
                // Hide the notification badge
                notificationBadge.style.display = 'none';
                lowStockItemsDiv.innerHTML = '<span class="text-sm">No low stock items</span>';
            }

            // Show the modal
            const lowStockModal = new bootstrap.Modal(document.getElementById('lowStockModal'));
            lowStockModal.show();

            // Remove the notification badge when the modal is opened
            notificationBadge.style.display = 'none';
        })
        .catch(error => {
            console.error('Error fetching low stock items:', error);
            alert('An error occurred while fetching low stock items. Please try again later.');
        });
}

</script>
