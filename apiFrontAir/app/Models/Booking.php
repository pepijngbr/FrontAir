<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
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
     * Get the Flight that belongs to the Booking
     */
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    /**
     * Get the User that belongs to the Booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
