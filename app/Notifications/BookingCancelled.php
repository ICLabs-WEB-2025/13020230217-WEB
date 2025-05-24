<?php

   namespace App\Notifications;

   use Illuminate\Bus\Queueable;
   use Illuminate\Notifications\Notification;
   use Illuminate\Notifications\Messages\MailMessage;

   class BookingCancelled extends Notification
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
               ->subject('Pembatalan Booking Lapangan')
               ->line('Booking Anda untuk ' . $this->booking->field->name . ' pada ' . $this->booking->date . ' pukul ' . $this->booking->start_time . ' telah dibatalkan.');
       }
   }