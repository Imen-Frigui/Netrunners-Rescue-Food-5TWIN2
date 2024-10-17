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
                    <a href="{{ route('frontcharities') }}" class="btn bg-gradient-dark">Back</a>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
