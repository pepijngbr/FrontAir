<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'departure_airport_id',
        'arrival_airport_id',
        'departure_time',
        'arrival_time',
        'flight_number',
        'airline_id',
        'image',
        'price',
        'available_seats'
    ];

    /**
     * Get the airline that owns the Flight
     */
    public function airline(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }

    /**
     * Get the departure airport that owns the Flight
     */
    public function departureAirport(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Airport::class, 'id', 'departure_airport_id');
    }

    /**
     * Get the arrival airport that owns the Flight
     */
    public function arrivalAirport(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Airport::class, 'id', 'arrival_airport_id');
    }

    /**
     * Get the bookings for the flight.
     */
    public function bookings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
