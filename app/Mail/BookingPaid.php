<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingPaid extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $payment;

    /**
     * Create a new message instance.
     */
    public function __construct($booking, $payment)
    {
        $this->booking = $booking;
        $this->payment = $payment;
    }


    public function build()
    {
        return $this->subject('Pembayaran Booking Berhasil')
                    ->markdown('emails.booking_paid');
    }
}
