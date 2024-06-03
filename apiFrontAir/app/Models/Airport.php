<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'timezone',
    ];

    public function baggages()
    {
        return $this->hasMany(Baggage::class);
    }

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
