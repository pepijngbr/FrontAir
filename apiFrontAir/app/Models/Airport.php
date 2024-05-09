<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'city', 'country', 'iata', 'icao', 'timezone', 'latitude', 'longitude'];

    public function departure_gates()
    {
        return $this->hasMany(DepartureGate::class, 'departure');
    }

    public function baggages()
    {
        return $this->hasMany(Baggage::class);
    }

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
