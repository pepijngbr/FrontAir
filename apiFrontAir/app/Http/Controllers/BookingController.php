<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        // TODO: check if the user is logged in if they have any bookings
        // return Booking::all()->where('user_id', Auth::id());
        return Booking::all();
    }

    public function store(Request $request)
    {
        return Booking::create($request->all());
    }

    public function show(Booking $booking)
    {
        return $booking;
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update($request->all());
        return $booking;
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
    }
}
