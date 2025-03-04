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
        Schema::create('tbl_core_booking', function (Blueprint $table) {
            $table->id();
            $table->string('Car_type');
            $table->string('Manufacturer');
            $table->text('booking_images');
            $table->decimal('Car_price', 10, 2);
            $table->string('Model');
            $table->string('Capacity');
            $table->string('Fuel_type');
            $table->string('Colors');
            $table->text('Description');
            $table->text('Policy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_core_booking');
    }
};
