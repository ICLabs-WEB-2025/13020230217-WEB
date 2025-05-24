<?php

   namespace App\Jobs;

   use App\Models\Booking;
   use Illuminate\Bus\Queueable;
   use Illuminate\Contracts\Queue\ShouldQueue;
   use Illuminate\Queue\InteractsWithQueue;
   use Illuminate\Queue\SerializesModels;

   class SendBookingReminder implements ShouldQueue
   {
       use Queueable, InteractsWithQueue, SerializesModels;

       public function handle()
       {
           $bookings = Booking::where('date', now()->toDateString())
               ->where('start_time', now()->addHour()->toTimeString())
               ->where('payment_status', 'Dibayar')
               ->get();

           foreach ($bookings as $booking) {
               $booking->user->notify(new \App\Notifications\BookingReminder($booking));
           }
       }
   }