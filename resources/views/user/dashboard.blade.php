@extends('layouts.app')

@section('title', 'Dashboard Pengguna')

@section('content')
<div class="container py-4">
    <!-- Filter Lapangan -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Lapangan</h4>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('user.dashboard') }}">
                <div class="row">
                    <div class="col-md-6">
                        <label for="sport_type" class="form-label">Jenis Olahraga</label>
                        <select name="sport_type" class="form-select">
                            <option value="">Semua Jenis</option>
                            <option value="Futsal" {{ request('sport_type') == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                            <option value="Badminton" {{ request('sport_type') == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                            <option value="Basket" {{ request('sport_type') == 'Basket' ? 'selected' : '' }}>Basket</option>
                        </select>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Lapangan Tersedia -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0"><i class="fas fa-list me-2"></i>Lapangan Tersedia</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($fields as $field)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-top bg-secondary" style="height: 180px; background-image: url('{{ $field->photo ? asset('storage/' . $field->photo) : asset('images/default-field.jpg') }}'); background-size: cover; background-position: center;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $field->name }}</h5>
                            <p class="card-text">
                                <span class="badge bg-info">{{ $field->sport_type }}</span>
                                <span class="badge bg-success">Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}/jam</span>
                            </p>
                            <p class="card-text">{{ Illuminate\Support\Str::limit($field->description, 100) }}</p>
                             <a href="{{ route('user.schedule', $field->id) }}" class="btn btn-primary w-100">Lihat Jadwal</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Tidak ada lapangan yang tersedia.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Riwayat Booking -->
    <div class="card shadow-sm">
        <div class="card-header bg-warning">
            <h4 class="mb-0"><i class="fas fa-history me-2"></i>Riwayat Booking Anda</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Lapangan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->field->name }}</td>
                            <td>{{ $booking->date }}</td>
                            <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                            <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td>
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="badge bg-info">Dikonfirmasi</span>
                                @elseif($booking->status == 'canceled')
                                    <span class="badge bg-danger">Dibatalkan</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                @if($booking->payment)
                                    @if($booking->payment->status == 'success')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Belum Bayar</span>
                                @endif
                            </td>
                            <td>
                                @if(!$booking->payment || $booking->payment->status != 'success')
                                    <a href="{{ route('user.payment.show', $booking) }}" 
                                       class="btn btn-sm btn-success"
                                       title="Lanjutkan Pembayaran">
                                       <i class="fas fa-money-bill-wave"></i>
                                    </a>
                                @endif
                                <a href="{{ route('user.book.download', $booking) }}" 
                                   class="btn btn-sm btn-primary"
                                   title="Cetak Invoice">
                                   <i class="fas fa-print"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada riwayat booking</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

