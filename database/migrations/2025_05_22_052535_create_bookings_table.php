<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   return new class extends Migration
   {
       public function up(): void
       {
           Schema::create('bookings', function (Blueprint $table) {
               $table->id();
               $table->foreignId('user_id')->constrained()->onDelete('cascade');
               $table->foreignId('field_id')->constrained()->onDelete('cascade');
               $table->foreignId('schedule_id')->constrained()->onDelete('cascade');
               $table->date('date');
               $table->time('start_time');
               $table->time('end_time');
               $table->decimal('total_cost', 10, 2);
               $table->string('payment_status')->default('Belum Dibayar');
               $table->string('payment_proof')->nullable();
               $table->timestamps();
           });
       }

       public function down(): void
       {
           Schema::dropIfExists('bookings');
       }
   };