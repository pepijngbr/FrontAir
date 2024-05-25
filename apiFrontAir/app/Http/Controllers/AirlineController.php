<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    /**
     * Returns all Airlines (if needed: limit & offset).
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit');
        $offset = $request->input('offset') ?? 0;

        if ($limit && $limit > 1 && $offset >= 0) {
            return Airline::take($limit)->skip($offset)->get();
        }

        return Airline::all();
    }

    /**
     * Creates a new Airline.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Airline
     */
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

    /**
     * Returns a specific Airline.
     * 
     * @param  \App\Models\Airline  $airline
     * @return \App\Models\Airline
     */
    public function show(Airline $airline)
    {
        return $airline;
    }

    /**
     * Updates a specific Airline.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Airline  $airline
     * @return \App\Models\Airline
     */
    public function update(Request $request, Airline $airline)
    {
        $airline->update($request->all());
        return $airline;
    }

    /**
     * Deletes a specific Airline.
     * 
     * @param  \App\Models\Airline  $airline
     */
    public function destroy(Airline $airline)
    {
        $airline->delete();
    }
}
