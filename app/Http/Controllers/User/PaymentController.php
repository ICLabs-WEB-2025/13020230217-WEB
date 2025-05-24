<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingPaid;

class PaymentController extends Controller
{
    public function show(Booking $booking)
    {
        return view('user.payment', compact('booking'));
    }

    public function process(Request $request, Booking $booking)
    {
        $request->validate([
            'method' => 'required|in:bank_transfer,e_wallet'
        ]);

        $payment = $booking->payment()->create([
            'method' => $request->method,
            'amount' => $booking->total_cost,
            'status' => 'pending',
            'booking_id' => $booking->id
        ]);

        return redirect()->route('user.payment.simulate', $payment);
    }

    public function showSimulation(Payment $payment)
    {
        return view('user.payment_simulation', compact('payment'));
    }

    public function confirmSimulation(Payment $payment)
    {
        $payment->update([
            'status' => 'success',
            'reference' => 'PAY-'.now()->timestamp,
            'paid_at' => now()
        ]);

        $payment->booking()->update([
             'payment_status' => 'lunas',  // Pastikan field ini ada di tabel bookings
            'status' => 'confirmed'
        ]);

        // Kirim notifikasi
        \Illuminate\Support\Facades\Mail::to($payment->booking->user->email)->send(
            new \App\Mail\BookingPaid($payment->booking, $payment)
        );

        return redirect()->route('user.bookings')
               ->with('success', 'Pembayaran berhasil!');
    }
}
