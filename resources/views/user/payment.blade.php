@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Pembayaran Booking</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('user.payment.process', $booking) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Metode Pembayaran</label>
                    <select name="method" class="form-select" required>
                        <option value="">Pilih Metode</option>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="e_wallet">E-Wallet</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Lanjut ke Pembayaran</button>
            </form>
        </div>
    </div>
</div>
@endsection