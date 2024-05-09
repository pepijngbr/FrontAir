<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartureGate extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['airport_id', 'gate', 'status'];

    /**
     * Get the airport that owns the departure gate.
     */
    public function airport()
    {
        return $this->belongsTo(Airport::class);
    }
}
