<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('field_images', function (Blueprint $table) {
            $table->id(); // Primary key (auto-incrementing ID)
            $table->foreignId('field_id')
                  ->constrained('fields') // Foreign key referencing the 'fields' table
                  ->onDelete('cascade');  // Cascade delete: remove images if the field is deleted
            $table->string('path'); // Column to store the image file path
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_images'); // Drop the table if it exists
    }
};