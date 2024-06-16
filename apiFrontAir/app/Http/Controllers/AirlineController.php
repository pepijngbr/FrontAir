<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Airline;

class AirlineController extends Controller
{
    /**
     * Returns all Airlines (if needed: limit & offset).
     *
     * @param Request $request
     * @return Builder[]|Collection
     */
    public function index(Request $request): Collection|array
    {
        $query = Airline::query();
        foreach ($request->all() as $key => $value) { // key = column name (name, country, iata), value = search value (e.g. 'London', 'Great Brittain', 'LHR')
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
     * @param Request $request
     * @return Airline
     */
    public function store(Request $request): Airline
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
     * @param Airline $airline
     * @return Airline
     */
    public function show(Airline $airline): Airline
    {
        return $airline;
    }

    /**
     * Updates a specific Airline.
     *
     * @param Request $request
     * @param Airline $airline
     * @return Airline
     */
    public function update(Request $request, Airline $airline): Airline
    {
        $airline->update($request->all());
        return $airline;
    }

    /**
     * Deletes a specific Airline.
     *
     * @param Airline $airline
     */
    public function destroy(Airline $airline): void
    {
        $airline->delete();
    }
}
