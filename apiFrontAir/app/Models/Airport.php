<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name', 
        'city', 
        'country', 
        'iata_code', 
        'icao_code', 
        'timezone', 
        // 'latitude', 
        // 'longitude'
    ];

    // ICAO = International Civil Aviation Organization, 4-letter airport location identifier, e.g. EGLL = London Heathrow Airport
    // IATA = International Air Transport Association / IATA = location identifier, 3-letter code, e.g. LHR = London Heathrow Airport

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
