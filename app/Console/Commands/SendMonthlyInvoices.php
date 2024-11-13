<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InvoiceGenerated;
use Barryvdh\DomPDF\Facade\Pdf;

class SendMonthlyInvoices extends Command
{
    protected $signature = 'invoices:send-monthly';
    protected $description = 'Send monthly invoices to all sponsors';

    public function handle()
    {
        $startDate = now()->startOfMonth()->subMonth();
        $endDate = now()->startOfMonth();

        $sponsors = Sponsor::with(['events' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('event_date', [$startDate, $endDate]);
        }])->get();

        foreach ($sponsors as $sponsor) {
            $sponsoredEvents = $sponsor->events;
            $totalAmount = $sponsoredEvents->sum('pivot.sponsorship_amount');

            $data = [
                'sponsor' => $sponsor,
                'events' => $sponsoredEvents,
                'totalAmount' => $totalAmount,
                'startDate' => $startDate->format('d M Y'),
                'endDate' => $endDate->format('d M Y')
            ];

            // Generate PDF and send notification
            $pdf = Pdf::loadView('sponsors.invoice', $data);
            Notification::route('mail', $sponsor->email)->notify(new InvoiceGenerated($data));

            $this->info("Invoice sent to {$sponsor->name}");
        }
    }
}
