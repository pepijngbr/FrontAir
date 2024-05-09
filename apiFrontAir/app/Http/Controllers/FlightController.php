<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        return Flight::all();
    }

    public function store(Request $request)
    {
        return Flight::create($request->all());
    }

    public function show(Flight $flight)
    {
        return $flight;
    }

    public function update(Request $request, Flight $flight)
    {
        $flight->update($request->all());
        return $flight;
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();
    }
}
