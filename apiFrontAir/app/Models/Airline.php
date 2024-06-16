<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airline extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'iata',
        'icao',
        'callsign',
        'country',
        'operating_since'
    ];

    /**
     * Get the flights for the airline.
     *
     * @return HasMany
     */
    public function flights(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Flight::class);
    }

    /**
     * Get the airports for the airline.
     *
     * @return HasMany
     */
    public function airports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Airport::class);
    }
}
