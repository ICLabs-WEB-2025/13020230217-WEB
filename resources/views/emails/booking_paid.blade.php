@component('mail::message')
# Pembayaran Booking Berhasil

<p>Pembayaran booking Anda telah berhasil:</p>
<ul>
    <li>Lapangan: {{ $booking->field->name }}</li>
    <li>Tanggal: {{ $booking->date }}</li>
    <li>Waktu: {{ $booking->start_time }} - {{ $booking->end_time }}</li>
    <li>Total: Rp {{ number_format($payment->amount, 0, ',', '.') }}</li>
    <li>Kode Booking: {{ $booking->id }}</li>
</ul>

@component('mail::button', ['url' => route('user.bookings')])
Lihat Detail Booking
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent