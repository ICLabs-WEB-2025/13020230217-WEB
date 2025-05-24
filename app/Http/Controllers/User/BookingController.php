<?php

   namespace App\Http\Controllers\User;

   use App\Http\Controllers\Controller;
   use App\Models\Booking;
   use App\Models\Schedule;
   use App\Models\Field;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;
   use Barryvdh\DomPDF\Facade\Pdf;
   use App\Events\BookingCreated;

   class BookingController extends Controller
   {
       public function create($scheduleId)
       {
           $schedule = Schedule::findOrFail($scheduleId);
           $field = $schedule->field;
           $duration = (strtotime($schedule->end_time) - strtotime($schedule->start_time)) / 3600;
           $subtotal = $field->price_per_hour * $duration;
           $discount = (strtotime($schedule->start_time) < strtotime('12:00:00')) ? 0.1 * $subtotal : 0;
           $totalCost = $subtotal - $discount;

           return view('user.book', compact('schedule', 'field', 'subtotal', 'discount', 'totalCost'));
       }

       public function store(Request $request, $scheduleId)
       {
           $schedule = Schedule::findOrFail($scheduleId);
           $field = $schedule->field;
           $duration = (strtotime($schedule->end_time) - strtotime($schedule->start_time)) / 3600;
           $subtotal = $field->price_per_hour * $duration;
           $discount = (strtotime($schedule->start_time) < strtotime('12:00:00')) ? 0.1 * $subtotal : 0;
           $totalCost = $subtotal - $discount;

           $booking = Booking::create([
               'user_id' => Auth::id(),
               'field_id' => $field->id,
               'schedule_id' => $schedule->id,
               'date' => $schedule->date,
               'start_time' => $schedule->start_time,
               'end_time' => $schedule->end_time,
               'total_cost' => $totalCost,
               'payment_status' => 'Belum Dibayar',
           ]);

           $schedule->update(['status' => 'Dipesan']);

           event(new BookingCreated($booking));

           return redirect()->route('user.bookings')->with('success', 'Booking berhasil! Silakan lakukan pembayaran dalam 1 jam.');
       }

       public function index()
       {
           $bookings = Booking::where('user_id', Auth::id())->get();
           return view('user.bookings', compact('bookings'));
       }

       public function cancel($id)
       {
           $booking = Booking::findOrFail($id);
           if ($booking->payment_status == 'Dibayar') {
               // Logika pengembalian dana (opsional)
           }
           $booking->update(['payment_status' => 'Dibatalkan']);
           $booking->schedule->update(['status' => 'Tersedia']);

           Auth::user()->notify(new \App\Notifications\BookingCancelled($booking));

           return redirect()->route('user.bookings')->with('success', 'Booking dibatalkan.');
       }

       public function download($id)
       {
           $booking = Booking::findOrFail($id);
           $pdf = Pdf::loadView('user.booking_pdf', compact('booking'));
           return $pdf->download('transaksi_' . $booking->id . '.pdf');
       }
   }