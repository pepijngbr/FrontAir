<?php

namespace App\Http\Controllers;

use App\Models\DepartureGate;
use Illuminate\Http\Request;

class DepartureGateController extends Controller
{
    public function index()
    {
        return DepartureGate::all();
    }

    public function store(Request $request)
    {
        return DepartureGate::create($request->all());
    }

    public function show(DepartureGate $departureGate)
    {
        return $departureGate;
    }

    public function update(Request $request, DepartureGate $departureGate)
    {
        $departureGate->update($request->all());
        return $departureGate;
    }

    public function destroy(DepartureGate $departureGate)
    {
        $departureGate->delete();
    }
}
