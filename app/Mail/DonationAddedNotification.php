<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationAddedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Donation  $donation
     * @return void
     */
    public function __construct(Donation $donation, User $user)
    {
        $this->donation = $donation;
        $this->user = $user;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.donations.added')
                    ->subject('A New Donation Has Been Added!')
                    ->with([
                        'donation' => $this->donation,
                        'user' => $this->user,
                    ]);
    }
}