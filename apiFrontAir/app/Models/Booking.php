<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['user_id', 'flight_id', 'ticket_id', 'booking_date', 'booking_number', 'status'];

    /**
     * Get the User that owns the Booking
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the Flights that belong to the Booking
     */
    public function flights()
    {
        return $this->belongsTo(Flight::class);
    }

    /**
     * Get the Tickets that belongs to the Booking
     */
    public function tickets()
    {
        return $this->belongsTo(Ticket::class);
    }
}
