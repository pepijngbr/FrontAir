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
        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Airline Company');
            $table->string('iata_code')->default('XX');
            $table->string('icao_code')->default('XXX');
            $table->string('callsign')->default('Airline Callsign');
            $table->string('country')->default('Country');
            $table->integer('operating_since')->default(2024);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airlines');
    }
};
