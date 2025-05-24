<!DOCTYPE html>
   <html>
   <head>
       <title>Transaksi Booking</title>
       <style>
           body { font-family: Arial, sans-serif; }
           .container { width: 80%; margin: auto; }
           .header { text-align: center; }
           .details { margin-top: 20px; }
           .details p { margin: 5px 0; }
       </style>
   </head>
   <body>
       <div class="container">
           <div class="header">
               <h1>LapanganKu</h1>
               <h3>Detail Transaksi</h3>
           </div>
           <div class="details">
               <div class="detail-item">
                <span class="label">ID Booking:</span>
                <span class="value">{{ $booking->id }}</span>
            </div>

            <div class="detail-item">
                <span class="label">Lapangan:</span>
                <span class="value">{{ $booking->field->name }}</span>
            </div>

            <div class="detail-item">
                <span class="label">Tanggal:</span>
                <span class="value">{{ $booking->date }}</span>
            </div>

            <div class="detail-item">
                <span class="label">Waktu:</span>
                <span class="value">{{ $booking->start_time }} - {{ $booking->end_time }}</span>
            </div>

            <div class="detail-item">
                <span class="label">Total Biaya:</span>
                <span class="value">Rp {{ number_format($booking->total_cost, 0, ',', '.') }}</span>
            </div>

            <div class="detail-item">
                <span class="label">Status Pembayaran:</span>
                <!-- <span class="value {{ $booking->payment_status === 'success"> -->
                    @if($booking->payment && $booking->payment->status === 'success')
                        <span class="badge bg-success">LUNAS</span>
                    @else
                        <span class="badge bg-danger">BELUM DIBAYAR</span>
                    @endif
                </span>
           </div>
       </div>
   </body>
   </html>