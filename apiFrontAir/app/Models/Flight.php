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
        'price',
        'available_seats'
    ];

    /**
     * Get the airline that owns the Flight
     */
    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    /**
     * Get the departure airport that owns the Flight
     */
    public function departureAirport()
    {
        return $this->hasOne(Airport::class, 'id', 'departure_airport_id');
    }

    /**
     * Get the arrival airport that owns the Flight
     */
    public function arrivalAirport()
    {
        return $this->hasOne(Airport::class, 'id', 'arrival_airport_id');
    }

    /**
     * Get the tickets for the flight.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get the baggage for the flight.
     */
    public function baggage()
    {
        return $this->hasMany(Baggage::class);
    }

    /**
     * Get the departure gates for the flight.
     */
    public function departureGates()
    {
        return $this->hasMany(DepartureGate::class);
    }
}
