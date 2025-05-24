@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Daftar Booking Saya</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Lapangan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->field->name ?? '-' }}</td>
                            <td>{{ $booking->date ?? '-' }}</td>
                            <td>{{ $booking->start_time ?? '-' }} - {{ $booking->end_time ?? '-' }}</td>
                            <td>
                                @if($booking->status == 'paid')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning">Belum Bayar</span>
                                @endif
                            </td>
                            <td>
                                @if($booking->status == 'unpaid')
                                    <a href="{{ route('user.payment.show', $booking) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-money-bill-wave"></i> Bayar
                                    </a>
                                @endif
                                <a href="{{ route('user.book.download', $booking->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-print"></i> Cetak
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection