<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Charity Details"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4 ">
            <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
    <div class="d-flex justify-content-between align-items-center bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
        <h6 class="text-white text-capitalize ps-3 mb-0">{{ $charity->charity_name }} Details</h6>
        
        <div class="py-2 mr-5">
            <p class="position-relative d-inline-block mb-0  ">
            <button class="btn {{ $charity->reports_count > 0 ? 'btn-danger' : 'btn-info' }} position-relative">
            {{ $charity->reports_count }} Reports
                    <!-- Notification badge -->
                    <span class="position-absolute top-0 start-100 translate-middle ">
                        <span class="visually-hidden">Reports</span>
                    </span>
                </button>
            </p>
        </div>
    </div>
</div>
<style>
    .btn{
        margin-right:15px;
    }
</style>
                <div class="card-body px-4 py-2">
                    <h5>Charity Information</h5>







                    @php
                        // Contact info is already cast to array in the model
                        $email = $charity->contact_info['email'] ?? 'N/A';
                        $phone = $charity->contact_info['phone'] ?? 'N/A';

                        // Other fields (preferred_food_types, request_history, inventory_status, etc.)
                        $preferredFoodTypes = $charity->preferred_food_types;  // String or array of strings
                        $requestHistory = $charity->request_history;  // String or array
                        $inventoryStatus = $charity->inventory_status;  // String or array
                        $assignedDriversVolunteers = $charity->assigned_drivers_volunteers;  // String or array
                        $currentRequests = $charity->current_requests;  // String or array
                    @endphp

                    @php
                        // Prepare attributes for display
                        $attributes = [
                            'Charity Name' => htmlspecialchars($charity->charity_name),
                            'Address' => htmlspecialchars($charity->address),
                            'Contact Info' => 'Email: ' . htmlspecialchars($email) . '<br>Phone: ' . htmlspecialchars($phone),
                            'Charity Type' => ucfirst(htmlspecialchars($charity->charity_type)),
                            'Beneficiaries Count' => htmlspecialchars($charity->beneficiaries_count),
                            'Preferred Food Types' => !empty($preferredFoodTypes) ? htmlspecialchars(is_array($preferredFoodTypes) ? implode(', ', $preferredFoodTypes) : $preferredFoodTypes) : 'N/A',
                            'Last Received Donation' => $charity->last_received_donation ? $charity->last_received_donation->format('d/m/Y') : 'N/A',
                            'Donation Frequency' => htmlspecialchars($charity->donation_frequency),
                            'Request History' => !empty($requestHistory) ? nl2br(htmlspecialchars($requestHistory)) : 'N/A',
                            'Inventory Status' => !empty($inventoryStatus) ? nl2br(htmlspecialchars($inventoryStatus)) : 'N/A',
                            'Assigned Drivers/Volunteers' => !empty($assignedDriversVolunteers) ? htmlspecialchars(is_array($assignedDriversVolunteers) ? implode(', ', $assignedDriversVolunteers) : $assignedDriversVolunteers) : 'N/A',
                            'Current Requests' => !empty($currentRequests) ? nl2br(htmlspecialchars($currentRequests)) : 'N/A',
                            'Charity Rating' => htmlspecialchars($charity->charity_rating),
                            'Charity Approval Status' => function() use ($charity) {
                                $status = ucfirst($charity->charity_approval_status);
                                $badgeClass = match ($charity->charity_approval_status) {
                                    'approved' => 'bg-gradient-success',
                                    'pending' => 'bg-gradient-warning',
                                    'rejected' => 'bg-gradient-danger',
                                    default => 'bg-gradient-secondary',
                                };
                                return '<span class="badge badge-sm ' . $badgeClass . '">' . htmlspecialchars($status) . '</span>';
                            }
                        ];
                    @endphp

                    @foreach($attributes as $label => $value)
                        <div class="py-2 {{ $loop->index % 2 == 0 ? 'bg-light' : 'bg-white' }}">
                            <p>
                                <strong>{{ $label }}:</strong>
                                {!! is_callable($value) ? $value() : $value !!}
                            </p>
                        </div>
                    @endforeach

                    <!-- Back Button -->
                    <a href="{{ route('charities') }}" class="btn bg-gradient-dark">Back to Charities</a>
                </div>
  
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>

