<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baggage extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'flight_id',
        'ticket_id',
        'weight',
        'status'
    ];

    /**
     * Get the User that owns the Baggage
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the Flights that belong to the Baggage
     */
    public function flights()
    {
        return $this->belongsTo(Flight::class);
    }

    /**
     * Get the Tickets that belongs to the Baggage
     */
    public function tickets()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Get the Airports that belongs to the Baggage
     */
    public function airports()
    {
        return $this->belongsTo(Airport::class);
    }
}
