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
        if (!Schema::hasTable('tbl_core_customer')) { // Check if the table exists
            Schema::create('tbl_core_customer', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id'); // Fixed data type
                $table->string('firstname');
                $table->string('lastname');
                $table->string('address');
                $table->string('gender');
                $table->string('email')->unique();
                $table->string('phone_number');
                $table->string('user_images')->nullable();
                $table->timestamps();
            
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
            
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_core_customer');
    }
};
