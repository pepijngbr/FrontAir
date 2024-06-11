<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;

class AirportController extends Controller
{
    /**
     * Returns all Airports (if needed: limit & offset).
     *
     * @param \Illuminate\Http\Request $request
     */
    public function index(Request $request)
    {
        $query = Airport::query();

        // key = column name (name, country, iata), value = search value (e.g. 'London', 'Great Brittain', 'LHR')
        foreach ($request->all() as $key => $value) {
            if ($key !== 'id' && $key !== 'limit' && $key !== 'offset' && $key !== 'sort_by' && $key !== 'sort_order') { // exclude id, limit, and offset when filtering
                $query->where($key, 'like', '%' . $value . '%');
            }
        }

        // limit & offset
        $limit = $request->input('limit');
        $offset = $request->input('offset') ?? 0;
        if ($limit && $limit > 1 && $offset >= 0) {
            $query->take($limit)->skip($offset);
        }

        // sorting by and order
        $sortField = $request->input('sort_by');
        $sortOrder = $request->input('sort_order') ?? 'asc';
        if ($sortField) {
            $query->orderBy($sortField, $sortOrder);
        }

        // return the query result
        return $query->get();
    }

    /**
     * Creates a new Airport.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Airport
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'iata' => 'required|string',
            'icao' => 'required|string',
            'type' => 'required|string',
        ]);
        return Airport::create($request->all());
    }

    /**
     * Returns a specific Airport.
     *
     * @param \App\Models\Airport $airport
     * @return \App\Models\Airport
     */
    public function show(Airport $airport)
    {
        return $airport;
    }

    /**
     * Updates a specific Airport.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Airport $airport
     * @return \App\Models\Airport
     */
    public function update(Request $request, Airport $airport)
    {
        $airport->update($request->all());
        return $airport;
    }

    /**
     * Deletes a specific Airport.
     *
     * @param \App\Models\Airport $airport
     */
    public function destroy(Airport $airport)
    {
        $airport->delete();
    }
}
