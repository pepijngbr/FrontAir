<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['flight_number', 'airline_id', 'departure_airport_id', 'arrival_airport_id', 'departure_time', 'arrival_time', 'price', 'class', 'available_seats'];

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
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    /**
     * Get the arrival airport that owns the Flight
     */
    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    /**
     * Get the bookings for the flight.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
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
