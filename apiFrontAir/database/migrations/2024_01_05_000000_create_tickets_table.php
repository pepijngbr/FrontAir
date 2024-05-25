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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->unsignedBigInteger('user_id')->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('flight_id')->foreign('flight_id')->references('id')->on('flights');
            $table->datetime('booking_date');
            $table->string('seat_number');
            $table->string('class');
            $table->string('type');
            $table->decimal('price', 10, 2);
            $table->string('booking_status');
            $table->string('boarding_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
