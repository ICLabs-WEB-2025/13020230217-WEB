<?php

   namespace App\Listeners;

   use App\Events\BookingCreated;
   use Illuminate\Support\Facades\Auth;

   class SendBookingConfirmation
   {
       public function handle(BookingCreated $event)
       {
           $booking = $event->booking;
           $booking->user->notify(new \App\Notifications\BookingConfirmed($booking));
       }
   }