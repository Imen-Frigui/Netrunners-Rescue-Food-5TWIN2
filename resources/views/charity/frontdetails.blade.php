<x-navbars.Navbar activePage='charities'></x-navbars.Navbar>

<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <main class="main-content position-relative mt-7 max-height-vh-100 h-100 border-radius-lg">
     
        <div class="container-fluid py-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ $charity->charity_name }} Details</h6>
                        <div>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-LQjbQ1R/BNeX99hrzujfR72t39u56bD8gSkpX8z9HIe8IH+GPmB36Ju7B+0xDk1FfWyFr1BoQcoNUVZKHzUTsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CDN for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @php
    $rating = $charity->charity_rating; // Assuming charity_rating is between 0-5
    $fullStars = floor($rating); // Full stars
    $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0; // 1 if a half star is needed
    $emptyStars = 5 - ($fullStars + $halfStar); // Remaining empty stars
@endphp

<div class=" ps-3">
    <!-- Full Stars -->
    @for ($i = 0; $i < $fullStars; $i++)
        <i class="fas fa-star" style="color: gold;"></i>
    @endfor

    <!-- Half Star if applicable -->
    @if ($halfStar)
        <i class="fas fa-star-half-alt" style="color: gold;"></i>
    @endif

    <!-- Empty Stars -->
    @for ($i = 0; $i < $emptyStars; $i++)
        <i class="far fa-star" style="color: gold;"></i>
    @endfor

    <!-- Rating Number -->
    <strong style="color: gold; margin-left: 10px;">{{ number_format($rating, 2) }}</strong>
</div>
</div>
                    </div>
                </div>
                <div class="card-body px-4 py-2">
                    <h5>Charity Information</h5>

                    @php
                        // Decode JSON fields only if they are strings
                        $contactInfo = is_string($charity->contact_info) ? json_decode($charity->contact_info, true) : $charity->contact_info;
                        $preferredFoodTypes = is_string($charity->preferred_food_types) ? json_decode($charity->preferred_food_types) : (is_array($charity->preferred_food_types) ? $charity->preferred_food_types : []);
                        $requestHistory = is_string($charity->request_history) ? json_decode($charity->request_history, true) : (is_array($charity->request_history) ? $charity->request_history : []);
                        $inventoryStatus = is_string($charity->inventory_status) ? json_decode($charity->inventory_status, true) : (is_array($charity->inventory_status) ? $charity->inventory_status : []);
                        $assignedDriversVolunteers = is_string($charity->assigned_drivers_volunteers) ? json_decode($charity->assigned_drivers_volunteers) : (is_array($charity->assigned_drivers_volunteers) ? $charity->assigned_drivers_volunteers : []);
                        $currentRequests = is_string($charity->current_requests) ? json_decode($charity->current_requests, true) : (is_array($charity->current_requests) ? $charity->current_requests : []);
                    @endphp

                    @php
                        // Prepare attributes for display
                        $attributes = [
                            'Charity Name' => htmlspecialchars($charity->charity_name),
                            'Address' => htmlspecialchars($charity->address),
                            'Contact Info' => 'Email: ' . htmlspecialchars($contactInfo['email'] ?? 'N/A') . ' | Phone: ' . htmlspecialchars($contactInfo['phone'] ?? 'N/A'),
                            'Charity Type' => ucfirst(htmlspecialchars($charity->charity_type)),
                            'Beneficiaries Count' => htmlspecialchars($charity->beneficiaries_count),
                            'Preferred Food Types' => !empty($preferredFoodTypes) ? implode(', ', array_map('trim', $preferredFoodTypes)) : 'N/A',
                            'Last Received Donation' => $charity->last_received_donation ? $charity->last_received_donation->format('d/m/Y') : 'N/A',
                            'Donation Frequency' => htmlspecialchars($charity->donation_frequency),
                            'Request History' => !empty($requestHistory) ? 
                                '<ul>' . implode('', array_map(fn($request) => '<li>Item: ' . htmlspecialchars($request['item'] ?? 'N/A') . ', Quantity: ' . htmlspecialchars($request['quantity'] ?? 'N/A') . '</li>', $requestHistory)) . '</ul>' : 'N/A',
                            'Inventory Status' => !empty($inventoryStatus) ? 
                                '<ul>' . implode('', array_map(fn($inventory) => '<li>Item: ' . htmlspecialchars($inventory['item'] ?? 'N/A') . ', Quantity: ' . htmlspecialchars($inventory['quantity'] ?? 'N/A') . '</li>', $inventoryStatus)) . '</ul>' : 'N/A',
                            'Assigned Drivers/Volunteers' => !empty($assignedDriversVolunteers) ? implode(', ', array_map('htmlspecialchars', $assignedDriversVolunteers)) : 'N/A',
                            'Current Requests' => !empty($currentRequests) ? 
                                '<ul>' . implode('', array_map(fn($request) => '<li>Item: ' . htmlspecialchars($request['item'] ?? 'N/A') . ', Quantity: ' . htmlspecialchars($request['quantity'] ?? 'N/A') . '</li>', $currentRequests)) . '</ul>' : 'N/A',
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
                                {!! is_callable($value) ? $value() : $value !!} <!-- Check if callable and call -->
                            </p>
                        </div>
                    @endforeach

                    <!-- Back Button -->
                    <a href="{{ route('frontcharities') }}" class="btn bg-gradient-dark">Back</a>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
