<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airline;

class AirlineController extends Controller
{
    /**
     * Returns all Airlines (if needed: limit & offset).
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $query = Airline::query();
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

        return $query->get(); // return the query result
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
