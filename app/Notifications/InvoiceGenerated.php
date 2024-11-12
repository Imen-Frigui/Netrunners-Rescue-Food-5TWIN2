<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceGenerated extends Notification
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $pdf = Pdf::loadView('dashboard.sponsors.invoice', $this->data);
        $pdfContent = $pdf->output();

        return (new MailMessage)
            ->from('rescue-food@example.com', 'Rescue Food')
            ->subject('Your Sponsorship Invoice')
            ->greeting("Hello, {$notifiable->name}")
            ->line('Please find attached the invoice for your recent sponsorship.')
            ->attachData($pdfContent, 'invoice.pdf', [
                'mime' => 'application/pdf',
            ])
            ->line('Thank you for your support!');
    }
}
