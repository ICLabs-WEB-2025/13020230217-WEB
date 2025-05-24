<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   return new class extends Migration
   {
       public function up(): void
       {
           Schema::create('fields', function (Blueprint $table) {
               $table->id();
               $table->string('name')->unique();
               $table->string('sport_type');
               $table->decimal('price_per_hour', 10, 2);
               $table->text('description')->nullable();
               $table->string('photo')->nullable();
               $table->boolean('is_active')->default(true);
               $table->timestamps();
           });
       }

       public function down(): void
       {
           Schema::dropIfExists('fields');
       }
   };