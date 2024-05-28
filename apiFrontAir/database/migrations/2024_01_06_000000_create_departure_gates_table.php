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
        Schema::create('departure_gates', function (Blueprint $table) {
            $table->id();
            $table->string('gate_number');
            $table->unsignedBigInteger('airport_id')->foreign('airport_id')->references('id')->on('airports');
            $table->datetime('departure_time');
            $table->string('boarding_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departure_gates');
    }
};
