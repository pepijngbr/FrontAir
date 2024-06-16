<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    /**
     * Returns all Flights (if needed: limit & offset & filter on almost any field).
     */
    public function index(Request $request)
    {
        $query = Flight::query();
        foreach ($request->all() as $key => $value) {
            if ($key !== 'id' && $key !== 'departure_airport_id' && $key !== 'arrival_airport_id' && $key !== 'airline_id' && $key !== 'limit' && $key !== 'offset' && $key !== 'sort_by' && $key !== 'sort_order') { // exclude id, limit, offset, sort_by & sorting order when filtering
                $query->where($key, 'like', '%' . $value . '%');
            }
        }

        // limiting and offset filter
        $limit = $request->input('limit');
        $offset = $request->input('offset') ?? 0;
        if ($limit && $limit >= 1 && $offset >= 0) {
            $query->limit($limit)->offset($offset);
        }

        // sorting by and order filter
        $sortField = $request->input('sort_by');
        $sortOrder = $request->input('sort_order') ?? 'asc';
        if ($sortField) {
            $query->orderBy($sortField, $sortOrder);
        }

        // airline_id filter
        $airlineId = $request->input('airline_id');
        if ($airlineId) {
            $query->where('airline_id', $airlineId);
        }

        // Departure and arrival airports filter
        $departureAirportId = $request->input('departure_airport_id');
        $arrivalAirportId = $request->input('arrival_airport_id');
        if ($departureAirportId) {
            $query->where('departure_airport_id', $departureAirportId);
        }
        if ($arrivalAirportId) {
            $query->where('arrival_airport_id', $arrivalAirportId);
        }

        // Departure and arrival time filter
        $departureTime = $request->input('departure_time');
        $arrivalTime = $request->input('arrival_time');
        if ($departureTime) {
            $query->where('departure_time', $departureTime);
        }
        if ($arrivalTime) {
            $query->where('arrival_time', $arrivalTime);
        }

        return $query->with(['airline', 'departureAirport', 'arrivalAirport'])->get(); // return the query result
    }

    /**
     * Creates a new Flight.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Flight
     */
    public function store(Request $request)
    {
        $request->validate([
            'departure_airport_id' => 'required|integer',
            'arrival_airport_id' => 'required|integer',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
            'flight_number' => 'required|string',
            'airline_id' => 'required|integer',
            'price' => 'required|numeric',
            'available_seats' => 'required|integer'
        ]);
        return Flight::create($request->all());
    }

    /**
     * Returns a specific Flight.
     *
     * @param \App\Models\Flight $flight
     * @return \App\Models\Flight
     */
    public function show(Flight $flight)
    {
        $newFlight = Flight::query();
        $newFlight->find($flight->id);
        return $newFlight->with('departureAirport', 'arrivalAirport', 'airline')->get();
    }

    /**
     * Updates a specific Flight.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Flight $flight
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
     * @param \App\Models\Flight $flight
     */
    public function destroy(Flight $flight)
    {
        $flight->delete();
    }
}
