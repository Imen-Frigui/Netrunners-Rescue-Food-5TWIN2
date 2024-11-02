<h1>Driver Assigned</h1>
<p>Dear {{ $user->name }},</p>
<p>Your pickup request has been assigned to driver {{ $driver->user->name }}.</p>
<p>Driver Contact: {{ $driver->phone_number }}</p>