<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        return Booking::all();
    }

    public function store(Request $request)
    {
        return Booking::create($request->all());
    }

    public function show(Booking $booking)
    {
        // return ['booking' => $booking, 'user_id' => (int)$request->user_id];
        
        // $foundBooking = Booking::find($booking->id);
        // if ($booking->user_id != $foundBooking->user_id) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        //     if (!$booking) {
        //         return response()->json(['message' => 'Booking not found'], 404);
        //     }
        // }
        
        return $booking;
        return $booking->user()->get();
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
