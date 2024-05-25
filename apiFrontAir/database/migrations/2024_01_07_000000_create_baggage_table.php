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
        Schema::create('baggage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->foreign('user_id')->references('user_id')->on('users');
            $table->unsignedBigInteger('flight_id')->foreign('flight_id')->references('id')->on('flights');
            $table->unsignedBigInteger('ticket_id')->foreign('ticket_id')->references('ticket_id')->on('tickets');
            $table->float('weight');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baggage');
    }
};
