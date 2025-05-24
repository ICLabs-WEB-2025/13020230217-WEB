@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Dashboard Admin</h1>
    <p class="mb-4">Selamat datang, Admin! Kelola lapangan dan jadwal di <a href="{{ route('filament.admin.pages.dashboard') }}">panel admin</a>.</p>

    <!-- Tambahkan bagian ini -->
    <div class="row">
        <h2 class="mb-3">Daftar Lapangan</h2>
        @foreach($lapangans as $lapangan)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/'.$lapangan->gambar) }}" 
                         class="card-img-top" 
                         alt="Gambar Lapangan"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $lapangan->nama }}</h5>
                        <p class="card-text">
                            <span class="badge bg-primary">{{ $lapangan->jenis }}</span>
                        </p>
                        <a href="{{ route('admin.lapangan.edit', $lapangan->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End tambahan -->
</div>
@endsection

<!-- @extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h1>Dashboard Admin</h1>
<p>Selamat datang, Admin! Kelola lapangan dan jadwal di <a href="{{ route('filament.admin.pages') }}">panel admin</a>.</p>
@endsection -->