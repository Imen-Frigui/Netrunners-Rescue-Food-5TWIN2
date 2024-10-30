<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="donations-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Donation Management"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Manage Donations</h6>
                            </div>
                        </div>

                        <!-- Search and Button Section -->
                        <div class="d-flex justify-content-between align-items-center my-3 px-3">
                            <div class="input-group w-50">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search Donations...">
                            </div>
                            <div>
                                <a class="btn btn-success mb-3" href="{{ route('donation-management.create') }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Donation
                                </a>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table table-hover align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="align-middle text-center font-weight-bold">Donor Type</th>
                                            <th class="align-middle text-center font-weight-bold">Donated Food</th>
                                            <th class="align-middle text-center font-weight-bold">Quantity</th>
                                            <th class="align-middle text-center font-weight-bold">Status</th>
                                            <th class="align-middle text-center font-weight-bold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="donationTableBody">
                                        @foreach($donations as $donation)
                                        <tr>
                                            <td class="align-middle text-center">{{ $donation->donor_type }}</td>
                                            <td class="align-middle text-center">{{ $donation->food->food_name }}</td>
                                            <td class="align-middle text-center">{{ $donation->quantity }}</td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm 
                                                    @if ($donation->status == 'Pending') bg-warning 
                                                    @elseif ($donation->status == 'Approved') bg-success 
                                                    @elseif ($donation->status == 'Completed') bg-info 
                                                    @else bg-danger 
                                                    @endif">
                                                    {{ $donation->status }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button type="button" class="btn btn-info btn-sm details-button" data-donation-id="{{ $donation->id }}">View</button>
                                                <a href="{{ route('donation-management.edit', $donation->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $donation->id }}', '{{ $donation->food->food_name }}')">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $donations->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

    <!-- Donation Details Modal -->
    <div class="modal fade" id="donationDetailsModal" tabindex="-1" role="dialog" aria-labelledby="donationDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content animated-modal">
            <div class="modal-header bg-gradient-green text-center">
                <h5 class="modal-title w-100" id="donationDetailsModalLabel">Donation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-6 mb-3">
                        <label for="donorType" class="form-label">Donor Type</label>
                        <input type="text" id="donorType" class="form-control detail-input" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="foodName" class="form-label">Donated Food</label>
                        <input type="text" id="foodName" class="form-control detail-input" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="text" id="quantity" class="form-control detail-input" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" id="status" class="form-control detail-input" disabled>
                    </div>
                    <!-- Centered Donation Date -->
                    <div class="col-12 mb-3 text-center">
                        <label for="donationDate" class="form-label">Donation Date</label>
                        <input type="text" id="donationDate" class="form-control detail-input" disabled>
                    </div>
                    <!-- Full-width Remarks Section -->
                    <div class="col-12 mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea id="remarks" class="form-control detail-input" disabled rows="3"></textarea>
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
                    <p>Are you sure you want to delete <strong id="donationNameToDelete"></strong>?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteDonationForm" method="POST" action="{{ route('donation-management.destroy', $donation->id) }}">
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
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-toast-message="{{ session('success', '') }}">
            <div class="d-flex">
                <div class="toast-body">{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // jQuery for search functionality
        $('#searchInput').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('#donationTableBody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Function to show donation details in modal
        function showDonationDetails(donation) {
            $('#donorType').val(donation.donor_type);
            $('#foodName').val(donation.food_name);
            $('#quantity').val(donation.quantity);
            $('#status').val(donation.status);
            $('#donationDate').val(donation.donation_date);
            $('#remarks').val(donation.remarks);
            $('#donationDetailsModal').modal('show');
        }
        // Event handler for view buttons
        $(document).ready(function() {
            $('.details-button').on('click', function() {
                const donationId = $(this).data('donation-id');

                // Fetch donation details using AJAX
                $.get(`/donation-management/donations/${donationId}`, function(donation) {
                    showDonationDetails(donation);
                }).fail(function() {
                    console.error('Failed to fetch donation details.');
                });
            });
        });

        // Delete confirmation modal function
        function confirmDelete(donationId, donationName) {
            $('#donationNameToDelete').text(donationName);
            $('#deleteDonationForm').attr('action', `/donation-management/donations/${donationId}`);
            $('#deleteConfirmationModal').modal('show');
        }

        // Show success toast if session contains a success message
        $(document).ready(function() {
            var toastMessage = $('#successToast').data('toast-message');
            if (toastMessage) {
                var toast = new bootstrap.Toast($('#successToast')[0]);
                toast.show();
            }
        });
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

        .modal-header.bg-gradient-green {
            background: linear-gradient(45deg, #28a745, #218838);
            /* Green gradient */
            color: white;
            text-align: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .modal-content.animated-modal {
            animation: fadeInScale 0.5s ease-out;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        .detail-input {
            background-color: #f0f4f8;
            border: 1px solid #d1d9e6;
            padding: 0.5rem;
            border-radius: 5px;
            font-weight: 500;
            color: #333;
            transition: all 0.3s ease;
        }

        .detail-input:focus {
            border-color: #218838;
            outline: none;
        }

        /* Keyframes for fade-in and scale animation */
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</x-layout>