<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;

class AirportController extends Controller
{
    /**
     * Returns all Airports (if needed: limit & offset).
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $query = Airport::query();
        foreach ($request->all() as $key => $value) { // key = column name (name, country, iata_code), value = search value (e.g. 'London', 'Great Brittain', 'LHR')
            if ($key !== 'id' && $key !== 'limit' && $key !== 'offset' && $key !== 'sort_by' && $key !== 'sort_order') { // exclude id, limit, and offset when filtering
                $query->where($key, 'like', '%' . $value . '%');
            }
        }

        // add the limit and offset here
        $limit = $request->input('limit');
        $offset = $request->input('offset') ?? 0;
        if ($limit && $limit > 1 && $offset >= 0) {
            $query->take($limit)->skip($offset);
        }

        // add the sorting here
        $sortField = $request->input('sort_by');
        $sortOrder = $request->input('sort_order') ?? 'asc';
        if ($sortField) {
            $query->orderBy($sortField, $sortOrder);
        }

        // e.g. http://127.0.0.1:8000/api/airports?name=tes&offset=2&limit=2&sort_by=name&sort_order=asc
        return $query->get(); // return the query result
    }

    /**
     * Creates a new Airport.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Airport
     */
    public function store(Request $request)
    {
        // TODO: validate request
        $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'iata' => 'required|string',
            'icao' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'altitude' => 'required|numeric',
            'timezone' => 'required|string',
            'dst' => 'required|string',
            'tz' => 'required|string',
            'type' => 'required|string',
            'source' => 'required|string',
        ]);
        return Airport::create($request->all());
    }

    /**
     * Returns a specific Airport.
     * 
     * @param  \App\Models\Airport  $airport
     * @return \App\Models\Airport
     */
    public function show(Airport $airport)
    {
        return $airport;
    }

    /**
     * Updates a specific Airport.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Airport  $airport
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
     * @param  \App\Models\Airport  $airport
     */
    public function destroy(Airport $airport)
    {
        $airport->delete();
    }
}
