<!-- resources/views/dashboard/sponsors/reports/sponsor_details.blade.php -->

<div class="section">
    <div class="title">Sponsor Report for {{ $sponsor->name }}</div>
    <div class="section-title">Sponsor Details</div>
    <p><strong>Email:</strong> {{ $sponsor->email }}</p>
    <p><strong>Phone:</strong> {{ $sponsor->phone }}</p>
    <p><strong>Company:</strong> {{ $sponsor->company }}</p>

    <div class="section-title">Sponsored Events</div>
    <table>
        <thead>
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
                    <td>${{ $event->pivot->sponsorship_amount }}</td>
                    <td>{{ ucfirst($event->pivot->sponsorship_level) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
