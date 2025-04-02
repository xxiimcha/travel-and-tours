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
        Schema::create('logistics_booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_booking_id'); // link to booking if needed
            $table->string('vehicle_type_needed');
            $table->boolean('sent_to_reservation_system')->default(false); // status for integration
            $table->timestamps();

            $table->foreign('customer_booking_id')->references('id')->on('customer_booking')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistics_booking');
    }
};
