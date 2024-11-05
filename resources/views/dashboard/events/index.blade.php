<title>@yield('title', 'Rscue Food') - List Event</title>
<x-layout bodyClass="g-sidenav-show bg-gray-200">

    @section('styles')
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    @endsection
    
      <x-navbars.sidebar activePage='events'></x-navbars.sidebar>
        <!-- Navbar -->
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Events Dashboard"></x-navbars.navs.auth>
            <div class="container-fluid py-4">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i> Events
                            <a href="{{ route('events.create') }}" role="button" class="btn btn-primary btn-spinner btn-sm pull-right m-b-0"><i class="fa fa-plus"></i>&nbsp; New Event</a>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('events.index') }}" class="mb-4">
                                <div class="row align-items-center">
                                    <!-- Search Field -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="search">Search</label>
                                            <input type="text" name="search" id="search" placeholder="Search events" value="{{ old('search', $query) }}" class="form-control">
                                        </div>
                                    </div>
        
                                    <!-- Event Date Filter -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="event_date">Event Date</label>
                                            <input type="date" name="event_date" id="event_date" value="{{ old('event_date', $eventDate) }}" class="form-control">
                                        </div>
                                    </div>
        
                                    <!-- Restaurant Filter -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="restaurant_id">Restaurant</label>
                                            <select name="restaurant_id" id="restaurant_id" class="form-control">
                                                <option value="">Select Restaurant</option>
                                                @foreach($restaurants as $restaurant)
                                                    <option value="{{ $restaurant->id }}" {{ $restaurant->id == old('restaurant_id', $restaurantId) ? 'selected' : '' }}>
                                                        {{ $restaurant->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
        
                                    <!-- Search Button -->
                                    <div class="col-md-2 mb-1">
                                        <div class="form-group mt-5">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="user-detail-tooltips-list col"></div>
                            <div class="table-responsive">
                                <table class="table table-hover table-listing col">
                                    <thead>
                                        <tr>
                                            <th class="bulk-checkbox"><input id="enabled" type="checkbox"
                                                    data-vv-name="enabled" name="enabled_fake_element"
                                                    class="form-check-input" aria-required="false" aria-invalid="false">
                                                <label for="enabled" class="form-check-label">
                                                    #
                                                </label></th>
                                            <th><a><span class="fa fa-sort-amount-asc"></span> #</a></th>
                                            <th><a><span class="fa"></span> Title</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Published At</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Event Date</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Max Participants</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Restaurant</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Charity</a></th>
                                            <th class="text-center"><a><span class="fa"></span> Actions</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($events as $event)
                                            <tr id="event-row-{{ $event->id }}">
                                                <td class="bulk-checkbox"><input id="enabled{{ $event->id }}" type="checkbox"
                                                        data-vv-name="enabled{{ $event->id }}" name="enabled{{ $event->id }}_fake_element"
                                                        class="form-check-input" aria-required="false" aria-invalid="false">
                                                    <label for="enabled{{ $event->id }}" class="form-check-label"></label></td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="font-size: .875rem;">{{ \Illuminate\Support\Str::limit($event->name, 10, '...') }}</td>
                                                <td style="font-size: .875rem;">
                                                    <span>
                                                        <small>Article will be published at</small><br>
                                                        {{ $event->published_at ? $event->published_at->format('d.m.Y, H:i') : 'Not Set' }}
                                                        <span title="Publish later" role="button" class="cursor-pointer">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                    @if (!$event->enabled) <!-- Check if the event is not enabled -->
                                                        <div>
                                                            <form class="d-inline" method="POST" action="{{ route('events.publish', $event->id) }}">
                                                                @csrf
                                                                <button type="submit" title="Publish now" class="btn btn-sm btn-success text-white">
                                                                    <i class="fa fa-send"></i>&nbsp;&nbsp;Publish now
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </td>                                                
                                                <td style="font-size: .875rem;">{{ $event->event_date ? $event->event_date->format('Y-m-d H:i') : 'N/A' }}</td>
                                                <td style="font-size: .875rem;">{{ $event->max_participants }}</td>
                                                <td style="font-size: .875rem;">{{ $event->restaurant ? $event->restaurant->name : 'No Set' }}</td>
                                                <td style="font-size: .875rem;">{{ $event->charity ? $event->charity->charity_name : 'No Set' }}</td>
                                                <td>
                                                    <div class="row no-gutters">
                                                        <div class="col-auto"><a href="{{ route('events.edit', $event->id) }}"
                                                                title="Edit" role="button"
                                                                class="btn btn-md btn-spinner btn-info"><i
                                                                    class="fa fa-edit"></i></a></div>
                                                        <form class="col" method="POST" action="{{ route('events.destroy', $event->id) }}" onsubmit="event.preventDefault(); deleteEvent({{ $event->id }});">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete" class="btn btn-md btn-danger"><i class="fa fa-trash-o"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm"><span class="pagination-caption">
                                    Displaying items from 1 to {{ $events->count() }} of total {{ $events->total() }} items.</span>
                                </div>
                                <div class="col-sm-auto">
                                    {{ $events->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @section('scripts')
    <script>
        function deleteEvent(eventId) {
            if(confirm('Are you sure you want to delete this event?')) {
                fetch(`/events/${eventId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        document.getElementById(`event-row-${eventId}`).remove();
                        
                        recalculateRowNumbers();
    
                        updatePagination();
    
                        alert('Event deleted successfully.');
                    } else {
                        alert('Failed to delete the event.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the event.');
                });
            }
        }
    
        function recalculateRowNumbers() {
            let rows = document.querySelectorAll('.table-listing tbody tr');
            rows.forEach((row, index) => {
                row.querySelector('td:nth-child(2)').innerText = index + 1;
            });
        }
    
        function updatePagination() {
            let currentCount = document.querySelectorAll('.table-listing tbody tr').length;
            let totalItems = parseInt(document.querySelector('.pagination-caption').innerText.match(/total (\d+)/)[1]);
            let newTotal = totalItems - 1;
    
            document.querySelector('.pagination-caption').innerText = `Displaying items from 1 to ${currentCount} of total ${newTotal} items.`;
        }
    </script>
    
    @endsection

</x-layout>
