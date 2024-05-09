<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index()
    {
        return Airport::all();
    }

    public function store(Request $request)
    {
        return Airport::create($request->all());
    }

    public function show(Airport $airport)
    {
        return $airport;
    }

    public function update(Request $request, Airport $airport)
    {
        $airport->update($request->all());
        return $airport;
    }

    public function destroy(Airport $airport)
    {
        $airport->delete();
    }
}
