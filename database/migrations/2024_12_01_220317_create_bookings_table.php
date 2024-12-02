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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users (clients)
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Foreign key to services
            $table->foreignId('provider_id')->constrained('providers')->onDelete('cascade'); // Foreign key to providers
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade'); // Foreign key to cities
            $table->dateTime('booking_date'); // Date and time of booking
            $table->decimal('total_price', 10, 2); // Total price of the service
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
