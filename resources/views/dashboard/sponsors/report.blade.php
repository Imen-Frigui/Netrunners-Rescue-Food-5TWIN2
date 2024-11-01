<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sponsor Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .title { font-size: 24px; font-weight: bold; }
        .section { margin-top: 20px; }
        .section-title { font-size: 18px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<div class="title">Sponsor Report for {{ $sponsor->name }}</div>

<div class="section">
    <div class="section-title">Sponsor Details</div>
    <p><strong>Email:</strong> {{ $sponsor->email }}</p>
    <p><strong>Phone:</strong> {{ $sponsor->phone }}</p>
    <p><strong>Company:</strong> {{ $sponsor->company }}</p>
</div>

<div class="section">
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

</body>
</html>
