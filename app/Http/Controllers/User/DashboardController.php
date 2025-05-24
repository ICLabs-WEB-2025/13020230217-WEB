<?php

   namespace App\Http\Controllers\User;

   use App\Http\Controllers\Controller;
   use App\Models\Field;
   use App\Models\Schedule;
   use Illuminate\Http\Request;
   use App\Models\Booking;
    use App\Models\Payment;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Str;

   class DashboardController extends Controller
   {
       public function index(Request $request)
       {
           $sportType = $request->input('sport_type');
           $fields = Field::when($sportType, function ($query, $sportType) {
               return $query->where('sport_type', $sportType);
           })->get();

           // Riwayat booking user
            $bookings = Booking::with(['field', 'payment'])
                ->where('user_id', Auth::id())
                ->orderBy('date', 'desc')
                ->orderBy('start_time', 'desc')
                ->paginate(5);

           return view('user.dashboard', compact('fields', 'bookings'));
       }

       public function showSchedule($fieldId, Request $request)
       {
           $field = Field::findOrFail($fieldId);
           $date = $request->input('date', now()->toDateString());
           $schedules = Schedule::where('field_id', $fieldId)
               ->where('date', $date)
                ->orderBy('start_time')
               ->get();

           return view('user.schedule', compact('field', 'schedules', 'date'));
       }

        public function bookingHistory()
        {
            $bookings = Booking::with(['field', 'payment'])
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->latest()
                ->get();

            return view('user.booking_history', compact('bookings'));
        }

        public function paymentHistory()
        {
            $payments = Payment::with(['booking.field'])
                ->whereHas('booking', function($query) {
                    $query->where('user_id', Auth::id());
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('user.payment_history', compact('payments'));
        }

   }