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
     * Get the Baggage that belongs to the Ticket
     */
    public function baggage()
    {
        return $this->hasMany(Baggage::class);
    }

    /**
     * Get the Flight that belongs to the Ticket
     */
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    /**
     * Get the User that belongs to the Ticket
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
