<?php

   namespace App\Notifications;

   use Illuminate\Bus\Queueable;
   use Illuminate\Notifications\Notification;
   use Illuminate\Notifications\Messages\MailMessage;

   class BookingConfirmed extends Notification
   {
       use Queueable;

       protected $booking;

       public function __construct($booking)
       {
           $this->booking = $booking;
       }

       public function via($notifiable)
       {
           return ['mail'];
       }

       public function toMail($notifiable)
       {
           return (new MailMessage)
               ->subject('Konfirmasi Booking Lapangan')
               ->line('Booking Anda untuk ' . $this->booking->field->name . ' pada ' . $this->booking->date . ' pukul ' . $this->booking->start_time . ' telah dikonfirmasi.')
               ->line('Total Biaya: Rp ' . number_format($this->booking->total_cost, 2))
               ->line('Silakan lakukan pembayaran dalam waktu 1 jam.');
       }
   }