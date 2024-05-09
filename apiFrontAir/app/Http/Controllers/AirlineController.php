<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function index()
    {
        return Airline::all();
    }

    public function store(Request $request)
    {
        $airline = $request->validate([
            'name' => 'required|string',
            'iata' => 'required|string',
            'icao' => 'required|string',
            'callsign' => 'required|string',
            'country' => 'required|string',
        ]);
        return Airline::create($request->all());
    }

    public function show(Airline $airline)
    {
        return $airline;
    }

    public function update(Request $request, Airline $airline)
    {
        $airline->update($request->all());
        return $airline;
    }

    public function destroy(Airline $airline)
    {
        $airline->delete();
    }
}
