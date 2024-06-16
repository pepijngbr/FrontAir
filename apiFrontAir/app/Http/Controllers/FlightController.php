<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    /**
     * Returns all Flights (if needed: limit & offset & filter on almost any field).
     *
     * @param Request $request
     * @return Collection|array
     */
    public function index(Request $request): \Illuminate\Database\Eloquent\Collection|array
    {
        // Build a new query
        $query = Flight::query();

        // Loop through each request field
        foreach ($request->all() as $key => $value) {
            // exclude id, limit, offset, sort_by & sorting order when filtering
            if ($key !== 'id' && $key !== 'departure_airport_id' && $key !== 'arrival_airport_id' && $key !== 'airline_id' && $key !== 'limit' && $key !== 'offset' && $key !== 'sort_by' && $key !== 'sort_order') {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }

        // Limit and offset filter
        $limit = $request->input('limit');
        $offset = $request->input('offset') ?? 0;
        if ($limit && $limit >= 1 && $offset >= 0) {
            $query->limit($limit)->offset($offset); // Get all Flights, add limit if requested, offset is always 0
        }

        // Sort by and order filter
        $sortField = $request->input('sort_by');
        $sortOrder = $request->input('sort_order') ?? 'asc';
        if ($sortField) {
            $query->orderBy($sortField, $sortOrder); // Get Flights with sort_by field value from request
        }

        // airline_id filter
        $airlineId = $request->input('airline_id');
        if ($airlineId) {
            $query->where('airline_id', $airlineId); // Get Flights with airline_id field value from request
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
     * @param Request $request
     * @return Flight
     */
    public function store(Request $request): Flight
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
     * @param Flight $flight
     * @return Collection|\Illuminate\Database\Eloquent\Builder[]
     */
    public function show(Flight $flight): Collection|array
    {
        $newFlight = Flight::query();
        $newFlight->find($flight->id);
        return $newFlight->with('departureAirport', 'arrivalAirport', 'airline')->get();
    }

    /**
     * Updates a specific Flight.
     *
     * @param Request $request
     * @param Flight $flight
     * @return Flight
     */
    public function update(Request $request, Flight $flight): Flight
    {
        $flight->update($request->all());
        return $flight;
    }

    /**
     * Deletes a specific Flight.
     *
     * @param Flight $flight
     */
    public function destroy(Flight $flight): void
    {
        $flight->delete();
    }
}
