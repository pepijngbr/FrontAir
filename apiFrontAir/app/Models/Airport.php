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
    ];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
