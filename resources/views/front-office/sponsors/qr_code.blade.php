<!DOCTYPE html>
<html>
<head>
    <title>{{ $sponsor->name }} QR Code</title>
</head>
<body>
    <h1>QR Code for {{ $sponsor->name }}</h1>
    <div>
        {!! $qrCode !!}
    </div>
    <p>Attendees can scan this QR code to visit the sponsor's page.</p>
</body>
</html>
