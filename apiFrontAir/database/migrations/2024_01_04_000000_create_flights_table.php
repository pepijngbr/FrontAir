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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('departure_airport_id')->foreign('departure_airport_id')->references('id')->on('airports');
            $table->unsignedBigInteger('arrival_airport_id')->foreign('arrival_airport_id')->references('id')->on('airports');
            $table->datetime('departure_time');
            $table->datetime('arrival_time');
            $table->string('flight_number');
            $table->unsignedBigInteger('airline_id')->foreign('airline_id')->references('id')->on('airlines');
            $table->integer('image');
            $table->decimal('price', 10, 2);
            $table->integer('available_seats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
