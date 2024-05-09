<?php

namespace App\Http\Controllers;

use App\Models\Baggage;
use Illuminate\Http\Request;

class BaggageController extends Controller
{
    public function index()
    {
        return Baggage::all();
    }

    public function store(Request $request)
    {
        return Baggage::create($request->all());
    }

    public function show(Baggage $baggage)
    {
        return $baggage;
    }

    public function update(Request $request, Baggage $baggage)
    {
        $baggage->update($request->all());
        return $baggage;
    }

    public function destroy(Baggage $baggage)
    {
        $baggage->delete();
    }
}
