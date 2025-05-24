@extends('layouts.app')

   @section('title', 'Jadwal Lapangan')

   @section('content')
   <h1>Jadwal {{ $field->name }}</h1>
   <form method="GET">
       <div class="mb-3">
           <label for="date" class="form-label">Tanggal</label>
           <input type="date" name="date" class="form-control" value="{{ $date }}">
       </div>
       <button type="submit" class="btn btn-primary">Tampilkan</button>
   </form>

   <table class="table mt-4">
       <thead>
           <tr>
               <th>Waktu Mulai</th>
               <th>Waktu Selesai</th>
               <th>Status</th>
               <th>Aksi</th>
           </tr>
       </thead>
       <tbody>
           @foreach ($schedules as $schedule)
               <tr>
                   <td>{{ $schedule->start_time }}</td>
                   <td>{{ $schedule->end_time }}</td>
                   <td>{{ $schedule->status }}</td>
                   <td>
                       @if ($schedule->status == 'Tersedia')
                           <a href="{{ route('user.book', $schedule->id) }}" class="btn btn-success">Pesan</a>
                       @endif
                   </td>
               </tr>
           @endforeach
       </tbody>
   </table>
   @endsection