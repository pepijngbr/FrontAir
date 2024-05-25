<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'seat_number', 
        'type', 
        'price', 
        'status'
    ];

    /**
     * Get the Booking that owns the Ticket
     */
    public function bookings()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the Baggage that belongs to the Ticket
     */
    public function baggage()
    {
        return $this->hasMany(Baggage::class);
    }

    /**
     * Get the Flights that belongs to the Ticket
     */
    public function flights()
    {
        return $this->belongsTo(Flight::class);
    }

    /**
     * Get the Users that belongs to the Ticket
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
