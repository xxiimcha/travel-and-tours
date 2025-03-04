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
        Schema::create('tbl_core_tour', function (Blueprint $table) {
            $table->id();
            $table->string('destination_category');
            $table->string('destination_name');
            $table->text('destination_images')->nullable();
            $table->decimal('destination_price', 10, 2);
            $table->text('destination_location');
            $table->integer('destination_days');
            $table->text('destination_description'); // Change to text type
            $table->text('destination_included');
            $table->text('destination_policy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_core_tour');
    }
};
