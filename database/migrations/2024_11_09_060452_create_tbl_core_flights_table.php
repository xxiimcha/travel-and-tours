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
        Schema::create('tbl_core_flights', function (Blueprint $table) {
            $table->id();
            $table->string('flights_title');
            $table->decimal('flights_price', 10, 2);
            $table->date('flights_from');
            $table->date('flights_to');
            $table->text('flights_description');
            $table->text('flights_included');
            $table->text('flights_policy');
            $table->string('flights_images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_core_flights');
    }
};
