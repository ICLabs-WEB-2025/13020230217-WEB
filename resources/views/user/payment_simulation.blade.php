@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-warning">
            <h4>Pembayaran</h4>
        </div>
        <div class="card-body text-center">
            <p>Total: <strong>Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong></p>
            <p>Metode: <strong>{{ ucfirst(str_replace('_', ' ', $payment->method)) }}</strong></p>
            
            <form action="{{ route('user.payment.simulate.confirm', $payment) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-success btn-lg">
                    Konfirmasi Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>
@endsection