<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="beneficiaries-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Beneficiaries Management"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Manage Beneficiaries</h6>
                            </div>
                        </div>

                        <!-- Search and Button Section -->
                        <div class="d-flex justify-content-between align-items-center my-3 px-3">
                            <div class="input-group w-50">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search Beneficiaries...">
                            </div>
                            <div>
                                <a class="btn btn-info mb-3" href="{{ route('beneficiaries.create') }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Beneficiary
                                </a>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table table-hover align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="align-middle text-center font-weight-bold">Name</th>
                                            <th class="align-middle text-center font-weight-bold">Needs</th>
                                            <th class="align-middle text-center font-weight-bold">Type</th>
                                            <th class="align-middle text-center font-weight-bold">Managed By</th>
                                            <th class="align-middle text-center font-weight-bold">Status</th>
                                            <th class="align-middle text-center font-weight-bold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="beneficiaryTableBody">
                                        @foreach($beneficiaries as $beneficiary)
                                        <tr>
                                            <td class="align-middle text-center">{{ $beneficiary->name }}</td>
                                            <td class="align-middle text-center">{{ $beneficiary->needs }}</td>
                                            <td class="align-middle text-center">{{ $beneficiary->type }}</td>
                                            <td class="align-middle text-center">{{ $beneficiary->managedBy->name ?? 'N/A' }}</td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm 
                                                    {{ $beneficiary->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $beneficiary->status }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button type="button" class="btn btn-info btn-sm details-button" data-beneficiary-id="{{ $beneficiary->id }}">View</button>
                                                <a href="{{ route('beneficiaries.edit', $beneficiary->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $beneficiary->id }}', '{{ $beneficiary->name }}')">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $beneficiaries->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

    <!-- Beneficiary Details Modal -->
    <div class="modal fade" id="beneficiaryDetailsModal" tabindex="-1" role="dialog" aria-labelledby="beneficiaryDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content animated-modal">
                <div class="modal-header bg-gradient-info text-center">
                    <h5 class="modal-title w-100" id="beneficiaryDetailsModalLabel">Beneficiary Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-6 mb-3">
                            <label for="beneficiaryName" class="form-label">Name</label>
                            <input type="text" id="beneficiaryName" class="form-control detail-input" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="contactInfo" class="form-label">Contact Info</label>
                            <input type="text" id="contactInfo" class="form-control detail-input" disabled>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" class="form-control detail-input" disabled>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="needs" class="form-label">Needs</label>
                            <textarea id="needs" class="form-control detail-input" disabled rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" id="type" class="form-control detail-input" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" id="status" class="form-control detail-input" disabled>
                        </div>
                        <div class="col-md-12 mb-3 d-flex justify-content-center">
                            <div class="w-100 text-center">
                                <label for="managedBy" class="form-label">Managed By</label>
                                <input type="text" id="managedBy" class="form-control detail-input" disabled>
                            </div>
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
                    <p>Are you sure you want to delete <strong id="beneficiaryNameToDelete"></strong>?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteBeneficiaryForm" method="POST" action="">
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
            $('#beneficiaryTableBody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Function to show beneficiary details in modal
        function showBeneficiaryDetails(beneficiary) {
            $('#beneficiaryName').val(beneficiary.name);
            $('#contactInfo').val(beneficiary.contact_info);
            $('#address').val(beneficiary.address);
            $('#managedBy').val(beneficiary.managed_by);
            $('#needs').val(beneficiary.needs);
            $('#type').val(beneficiary.type);
            $('#status').val(beneficiary.status);
            $('#beneficiaryDetailsModal').modal('show');
        }

        // Event handler for view buttons
        $(document).ready(function() {
            $('.details-button').on('click', function() {
                const beneficiaryId = $(this).data('beneficiary-id');

                // Fetch beneficiary details using AJAX
                $.get(`/beneficiaries/${beneficiaryId}`, function(beneficiary) {
                    showBeneficiaryDetails(beneficiary);
                }).fail(function() {
                    console.error('Failed to fetch beneficiary details.');
                });
            });
        });

        // Delete confirmation modal function
        function confirmDelete(beneficiaryId, beneficiaryName) {
            $('#beneficiaryNameToDelete').text(beneficiaryName);
            $('#deleteBeneficiaryForm').attr('action', `/beneficiaries/${beneficiaryId}`);
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

        .modal-header.bg-gradient-info {
            background: linear-gradient(45deg, #007bff, #0056b3);
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
            border-color: #0056b3;
            outline: none;
        }

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