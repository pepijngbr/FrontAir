<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airport extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'city',
        'country',
        'iata',
        'icao',
    ];

    /**
     * Get the flights for the airport.
     *
     * @return HasMany
     */
    public function flights(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Flight::class);
    }
}
