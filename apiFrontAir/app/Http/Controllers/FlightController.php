<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Returns all Flights (if needed: limit & offset).
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit');
        $offset = $request->input('offset') ?? 0;

        if ($limit && $limit > 1 && $offset >= 0) {
            return Flight::take($limit)->skip($offset)->get();
        }

        return Flight::all();
    }

    /**
     * Creates a new Flight.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Flight
     */
    public function store(Request $request)
    {
        // TODO: validate request
        return Flight::create($request->all());
    }

    /**
     * Returns a specific Flight.
     * 
     * @param  \App\Models\Flight  $flight
     * @return \App\Models\Flight
     */
    public function show(Flight $flight)
    {
        $flight->load('departureAirport', 'arrivalAirport', 'airline');
        return $flight;
    }

    /**
     * Updates a specific Flight.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flight  $flight
     * @return \App\Models\Flight
     */
    public function update(Request $request, Flight $flight)
    {
        $flight->update($request->all());
        return $flight;
    }

    /**
     * Deletes a specific Flight.
     * 
     * @param  \App\Models\Flight  $flight
     */
    public function destroy(Flight $flight)
    {
        $flight->delete();
    }
}
