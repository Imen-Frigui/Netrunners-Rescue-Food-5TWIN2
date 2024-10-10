<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="food-management"></x-navbars.navbar.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <x-navbars.navs.auth titlePage="Food Management"></x-navbars.navs.auth>
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-success shadow-success  border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white mx-3">Manage Foods</h6>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center my-3 px-3">
                                <!-- Search bar -->
                                <div class="input-group w-50">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search Foods...">
                                </div>
                                <!-- Buttons section -->
                                <div>
                                    <a class="btn bg-gradient-info mb-0 me-3" href="{{ route('foods.export') }}">
                                        <i class="material-icons text-sm">file_download</i>&nbsp;&nbsp;Export to Excel
                                    </a>
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('foods.create') }}">
                                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Food
                                    </a>
                                </div>
                            </div>

                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table table-hover align-items-center mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="align-middle text-center font-weight-bold">Image</th>
                                                <th class="align-middle text-center font-weight-bold">Food Name</th>
                                                <th class="align-middle text-center font-weight-bold">Quantity</th>
                                                <th class="align-middle text-center font-weight-bold">Category</th>
                                                <th class="align-middle text-center font-weight-bold">Expiration Date</th>
                                                <th class="align-middle text-center font-weight-bold">Status</th>
                                                <th class="align-middle text-center font-weight-bold">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="foodTableBody">
                                            @foreach($foods as $food)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <img src="{{ $food->image }}" class="img-fluid avatar avatar-sm border-radius-lg" alt="food-image" style="max-width: 50px;">
                                                </td>
                                                <td class="align-middle text-center">{{ $food->food_name }}</td>
                                                <td class="align-middle text-center">{{ $food->quantity }}</td>
                                                <td class="align-middle text-center">{{ $food->category }}</td>
                                                <td class="align-middle text-center">{{ \Carbon\Carbon::parse($food->expiration_date)->format('d/m/Y') }}</td>
                                                <td class="align-middle text-center">
                                                    @if ($food->status == 'available')
                                                    <span class="badge bg-success">Available</span>
                                                    @elseif ($food->status == 'expired')
                                                    <span class="badge bg-danger">Expired</span>
                                                    @else
                                                    <span class="badge bg-secondary">Donated</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <!-- Dropdown action menu -->
                                                    <div class="dropdown">
                                                        <button class="btn btn-link p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-icons" style="font-size: 20px; color: black;">more_vert</i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <li>
                                                                <a class="dropdown-item text-success d-flex align-items-center" href="{{ route('foods.edit', $food->id) }}">
                                                                    <i class="material-icons me-2" style="font-size: 18px;">edit</i> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item text-danger d-flex align-items-center" type="button" onclick="confirmDelete('{{ $food->id }}', '{{ $food->food_name }}')">
                                                                    <i class="material-icons me-2" style="font-size: 18px;">delete</i> Delete
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item text-primary d-flex align-items-center details-button" href="#" data-food-id="{{ $food->id }}">
                                                                    <i class="material-icons me-2" style="font-size: 18px;">info</i> Details
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                {{ $foods->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>

            <!-- Food Details Modal -->
            <div class="modal fade" id="foodDetailsModal" tabindex="-1" role="dialog" aria-labelledby="foodDetailsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document"> <!-- Change to modal-md to reduce size -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="foodDetailsModalLabel">Food Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row text-center">
                                <!-- Image -->
                                <div class="col-md-12 mb-4">
                                    <label for="foodImage" class="form-label d-block">Image</label>
                                    <img id="foodImage" class="img-fluid img-thumbnail d-block mx-auto" style="max-width: 150px;" src="" alt="Food Image"> <!-- Resize and center image -->
                                </div>
                                <div class="col-md-6">
                                    <label for="foodName" class="form-label">Food Name</label>
                                    <input type="text" id="foodName" class="form-control" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="text" id="quantity" class="form-control" disabled>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="unit" class="form-label">Unit</label>
                                    <input type="text" id="unit" class="form-control" disabled>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="expirationDate" class="form-label">Expiration Date</label>
                                    <input type="text" id="expirationDate" class="form-control" disabled>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" id="category" class="form-control" disabled>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" id="status" class="form-control" disabled>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="storageConditions" class="form-label">Storage Conditions</label>
                                    <input type="text" id="storageConditions" class="form-control" disabled>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="donationDate" class="form-label">Donation Date</label>
                                    <input type="text" id="donationDate" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Are you sure you want to delete <strong id="foodNameToDelete"></strong>?</p>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form id="deleteFoodForm" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Toast Notification -->
            <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 9999;">
                <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true"
                    data-toast-message="{{ session('success', '') }}">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </main>
        <x-plugins></x-plugins>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Search bar functionality -->
        <script>
            document.getElementById('searchInput').addEventListener('keyup', function() {
                const value = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const rowText = row.innerText.toLowerCase();
                    row.style.display = rowText.includes(value) ? '' : 'none';
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                var successToast = document.getElementById('successToast');
                var toastMessage = successToast.getAttribute('data-toast-message');

                if (toastMessage) {
                    var toast = new bootstrap.Toast(successToast);
                    toast.show();
                }
            });

            function showFoodDetails(food) {
                document.getElementById('foodImage').src = food.image;
                document.getElementById('foodName').value = food.food_name;
                document.getElementById('quantity').value = food.quantity;
                document.getElementById('unit').value = food.unit;
                document.getElementById('expirationDate').value = food.expiration_date;
                document.getElementById('category').value = food.category;
                document.getElementById('status').value = food.status;
                document.getElementById('storageConditions').value = food.storage_conditions;
                document.getElementById('donationDate').value = food.donation_date;

                $('#foodDetailsModal').modal('show');
            }

            document.querySelectorAll('.details-button').forEach(button => {
                button.addEventListener('click', function() {
                    const foodId = this.getAttribute('data-food-id');

                    fetch(`/foods/${foodId}`)
                        .then(response => response.json())
                        .then(food => {
                            showFoodDetails(food);
                        })
                        .catch(error => console.error('Error fetching food details:', error));
                });
            });

            function confirmDelete(foodId, foodName) {
                // Set the food name in the modal
                document.getElementById('foodNameToDelete').textContent = foodName;

                // Set the form action to the correct route with the food ID
                var form = document.getElementById('deleteFoodForm');
                form.action = `/foods/${foodId}`;

                // Show the modal
                var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
                deleteModal.show();
            }
        </script>
        <style>
            .modal-body {
                text-align: center;
                font-weight: 500;
                font-size: 18px;
                color: black;
                padding-bottom: 5px;
            }

            .modal-footer {
                display: flex;
                justify-content: center;
                gap: 10px;
                padding-top: 2px;

                padding-bottom: 5px;
            }

            .modal-footer button,
            .modal-footer form button {
                display: inline-block;
                padding: 10px 20px;
                margin: 0;
                vertical-align: middle;
            }
        </style>
</x-layout>