<div class="section">
    <div class="mb-3">
        <h4 class="text-info"><i class="fa fa-info-circle"></i> Sponsor Details</h4>
        <p><strong>Email:</strong> {{ $sponsor->email }}</p>
        <p><strong>Phone:</strong> {{ $sponsor->phone }}</p>
        <p><strong>Company:</strong> {{ $sponsor->company }}</p>
    </div>

    <div class="section-title mb-2 text-white p-2 rounded">
        <h4 class="text-info"><i class="fa fa-info-circle"></i> Sponsored Events</h4>
    </div>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Max Participants</th>
                <th>Sponsorship Amount</th>
                <th>Sponsorship Level</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->event_date->format('Y-m-d') }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->max_participants }}</td>
                    <td>${{ number_format($event->pivot->sponsorship_amount, 2) }}</td>
                    <td>{{ ucfirst($event->pivot->sponsorship_level) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
