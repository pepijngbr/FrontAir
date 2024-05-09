<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['name', 'iata', 'icao', 'callsign', 'country', 'active'];

    /**
     * Get the flights for the airline.
     */
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

    /**
     * Get the airports for the airline.
     */
    public function airports()
    {
        return $this->hasMany(Airport::class);
    }
}
