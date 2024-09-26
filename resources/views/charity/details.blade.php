<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Charity Details"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ $charity->charity_name }} Details</h6>
                    </div>
                </div>
                <div class="card-body px-4 py-2">
                    <h5>Charity Information</h5>

                    <!-- Charity Information -->
                    @php
                        $attributes = [
                            'Charity Name' => $charity->charity_name,
                            'Address' => $charity->address,
                            'Contact Info' => 'Email: ' . ($charity->contact_info['email'] ?? 'N/A') . ' | Phone: ' . ($charity->contact_info['phone'] ?? 'N/A'),
                            'Charity Type' => ucfirst($charity->charity_type),
                            'Beneficiaries Count' => $charity->beneficiaries_count,
                            'Preferred Food Types' => is_array($charity->preferred_food_types) ? implode(', ', $charity->preferred_food_types) : 'N/A',
                            'Last Received Donation' => $charity->last_received_donation ? $charity->last_received_donation->format('d/m/Y') : 'N/A',
                            'Donation Frequency' => $charity->donation_frequency,
                            'Request History' => is_array($charity->request_history) && count($charity->request_history) > 0 ? 
                                                '<ul>' . implode('', array_map(fn($request) => '<li>Item: ' . ($request['item'] ?? 'N/A') . ', Quantity: ' . ($request['quantity'] ?? 'N/A') . '</li>', $charity->request_history)) . '</ul>' : 'N/A',
                            'Inventory Status' => is_array($charity->inventory_status) && count($charity->inventory_status) > 0 ? 
                                                 '<ul>' . implode('', array_map(fn($inventory) => '<li>Item: ' . ($inventory['item'] ?? 'N/A') . ', Quantity: ' . ($inventory['quantity'] ?? 'N/A') . '</li>', $charity->inventory_status)) . '</ul>' : 'N/A',
                            'Assigned Drivers/Volunteers' => is_array($charity->assigned_drivers_volunteers) ? implode(', ', $charity->assigned_drivers_volunteers) : 'N/A',
                            'Current Requests' => is_array($charity->current_requests) && count($charity->current_requests) > 0 ? 
                                                 '<ul>' . implode('', array_map(fn($request) => '<li>Item: ' . ($request['item'] ?? 'N/A') . ', Quantity: ' . ($request['quantity'] ?? 'N/A') . '</li>', $charity->current_requests)) . '</ul>' : 'N/A',
                            'Charity Rating' => $charity->charity_rating,
                            'Charity Approval Status' => function() use ($charity) {
                                $status = ucfirst($charity->charity_approval_status);
                                $badgeClass = '';

                                if ($charity->charity_approval_status === 'approved') {
                                    $badgeClass = 'bg-gradient-success';
                                } elseif ($charity->charity_approval_status === 'pending') {
                                    $badgeClass = 'bg-gradient-warning';
                                } elseif ($charity->charity_approval_status === 'rejected') {
                                    $badgeClass = 'bg-gradient-danger';
                                } else {
                                    $badgeClass = 'bg-gradient-secondary'; 
                                }

                                return '<span class="badge badge-sm ' . $badgeClass . '">' . $status . '</span>';
                            }                     
                        ];
                    @endphp

                    @foreach($attributes as $label => $value)
                        <div class="py-2 {{ $loop->index % 2 == 0 ? 'bg-light' : 'bg-white' }}">
                            <p>
                                <strong>{{ $label }}:</strong> 
                                {!! is_callable($value) ? $value() : $value !!} <!-- Check if callable and call -->
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
