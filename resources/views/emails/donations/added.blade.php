<x-mail::message>
{{-- Custom header with logo and background color --}}
<div style="text-align: center; padding: 20px; background-color: #e0f7ea; color: white;">
    <h1 style="margin-top: 15px; font-size: 24px;">New Donation Added to Rescue Food!</h1>
</div>

{{-- Greeting and Introduction --}}
<p style="font-size: 18px; color: #333; text-align: center;">Hello {{ $user->name }},</p>
<p style="font-size: 16px; color: #666;">
    We’re excited to inform you that a new donation has been added to the <strong>Rescue Food</strong> platform. Below are the details of the donation:
</p>

{{-- Donation Summary Section --}}
<div style="padding: 15px; background-color: #e0f7ea; border: 1px solid #ddd; border-radius: 8px; margin-top: 10px;">
    <h2 style="color: #4caf50; font-size: 20px; text-align: center; margin-bottom: 15px;">Donation Summary</h2>
    <ul style="list-style-type: none; padding: 0; font-size: 16px; color: #333;">
        <li><strong>Food Item:</strong> {{ $donation->food->food_name }}</li>
        <li><strong>Beneficiary:</strong> {{ $donation->beneficiary->name }}</li>
        <li><strong>Donor Type:</strong> {{ $donation->donor_type }}</li>
        <li><strong>Quantity:</strong> {{ $donation->quantity }}</li>
        <li><strong>Status:</strong> {{ $donation->status }}</li>
        <li><strong>Date of Donation:</strong> {{ \Carbon\Carbon::parse($donation->donation_date)->format('d-m-Y') }}</li>
        <li><strong>Remarks:</strong> {{ $donation->remarks }}</li>
    </ul>
</div>

{{-- Closing Section --}}
<p style="font-size: 16px; color: #666; margin-top: 30px;">
    Thank you for being a part of our mission to reduce food waste and help those in need. Your support is invaluable to us!
</p>

<p style="font-size: 16px; color: #333;">
    Sincerely,<br>
    The {{ config('app.name') }} Team
</p>
</x-mail::message>
