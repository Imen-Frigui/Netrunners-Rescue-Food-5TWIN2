<div class="section">
    <h2 class="text-primary">Engagement Report for {{ $sponsor->name }}</h2>
    <p class="text-muted">Total Scans: <strong>{{ $totalScans }}</strong></p>

    <table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>Event Name</th>
                <th>Scan Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach($scansPerEvent as $scan)
                <tr>
                    <td>{{ optional($events->find($scan->event_id))->name ?? 'N/A' }}</td>
                    <td>{{ $scan->count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
