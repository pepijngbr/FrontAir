<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    /**
     * Returns all Airports (if needed: limit & offset).
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit');
        $offset = $request->input('offset') ?? 0;

        if ($limit && $limit > 1 && $offset >= 0) {
            return Airport::take($limit)->skip($offset)->get();
        }

        return Airport::all();
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
