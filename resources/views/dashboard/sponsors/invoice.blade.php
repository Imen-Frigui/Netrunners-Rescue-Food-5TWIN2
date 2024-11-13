<!-- resources/views/sponsors/invoice.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        /* Basic styling for the PDF */
        body { font-family: Arial, sans-serif; }
        .header, .footer { text-align: center; }
        .content { margin: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table, .table th, .table td { border: 1px solid black; padding: 8px; text-align: left; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Invoice for {{ $sponsor->name }}</h1>
        <p>From: {{ $startDate }} to {{ $endDate }}</p>
    </div>

    <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Sponsorship Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->event_date->format('d M Y') }}</td>
                        <td>${{ number_format($event->pivot->sponsorship_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total">
                    <td colspan="2">Total Sponsorship Amount</td>
                    <td>${{ number_format($totalAmount, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="footer">
        <p>Thank you for your sponsorship!</p>
    </div>
</body>
</html>
