<div class="section mt-5">
    <h4 class="text-danger"><i class="fa fa-bar-chart"></i> Engagement Report for {{ $sponsor->name }}</h4>
    <p class="text-muted">Total Scans: <strong>{{ $totalScans }}</strong></p>

    <table class="table table-hover table-striped">
        <thead class="table-secondary">
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
