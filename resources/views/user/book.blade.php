@extends('layouts.app')

   @section('title', 'Pesan Lapangan')

   @section('content')
   <h1>Pesan {{ $field->name }}</h1>
   <div class="card">
       <div class="card-body">
           <p><strong>Lapangan:</strong> {{ $field->name }}</p>
           <p><strong>Jenis Olahraga:</strong> {{ $field->sport_type }}</p>
           <p><strong>Tanggal:</strong> {{ $schedule->date }}</p>
           <p><strong>Waktu:</strong> {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
           <p><strong>Subtotal:</strong> Rp {{ number_format($subtotal, 2) }}</p>
           @if ($discount > 0)
               <p><strong>Diskon:</strong> Rp {{ number_format($discount, 2) }}</p>
           @endif
           <p><strong>Total Biaya:</strong> Rp {{ number_format($totalCost, 2) }}</p>
           <form method="POST" action="{{ route('user.book.store', $schedule->id) }}">
               @csrf
               <button type="submit" class="btn btn-primary">Konfirmasi Booking</button>
           </form>
       </div>
   </div>
   @endsection