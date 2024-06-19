<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departure_airport_id');
            $table->foreignId('arrival_airport_id');
            $table->datetime('departure_time');
            $table->datetime('arrival_time');
            $table->string('flight_number');
            $table->foreignId('airline_id');
            $table->integer('image');
            $table->decimal('price', 10, 2);
            $table->integer('available_seats');
            $table->timestamps();

            $table->foreign('departure_airport_id')->references('id')->on('airports')->onDelete('cascade');
            $table->foreign('arrival_airport_id')->references('id')->on('airports')->onDelete('cascade');
            $table->foreign('airline_id')->references('id')->on('airlines')->onDelete('cascade');
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
