<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Airport;

class AirportController extends Controller
{
    /**
     * Returns all Airports (if needed: limit & offset).
     *
     * @param Request $request
     * @return Builder[]|Collection
     */
    public function index(Request $request): Collection|array
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
     * @param Request $request
     * @return Airport
     */
    public function store(Request $request): Airport
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
     * @param Airport $airport
     * @return Airport
     */
    public function show(Airport $airport): Airport
    {
        return $airport;
    }

    /**
     * Updates a specific Airport.
     *
     * @param Request $request
     * @param Airport $airport
     * @return Airport
     */
    public function update(Request $request, Airport $airport): Airport
    {
        $airport->update($request->all());
        return $airport;
    }

    /**
     * Deletes a specific Airport.
     *
     * @param Airport $airport
     */
    public function destroy(Airport $airport): void
    {
        $airport->delete();
    }
}
