@extends('layouts.app')

   @section('title', 'Pendaftaran')

   @section('content')
   <div class="row justify-content-center">
       <div class="col-md-6">
           <div class="card">
               <div class="card-header">Pendaftaran</div>
               <div class="card-body">
                   <form method="POST" action="{{ route('register') }}">
                       @csrf
                       <div class="mb-3">
                           <label for="name" class="form-label">Nama</label>
                           <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                           @error('name')
                               <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="mb-3">
                           <label for="email" class="form-label">Email</label>
                           <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                           @error('email')
                               <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="mb-3">
                           <label for="password" class="form-label">Kata Sandi</label>
                           <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                           @error('password')
                               <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="mb-3">
                           <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                           <input type="password" name="password_confirmation" class="form-control">
                       </div>
                       <button type="submit" class="btn btn-primary">Daftar</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
   @endsection