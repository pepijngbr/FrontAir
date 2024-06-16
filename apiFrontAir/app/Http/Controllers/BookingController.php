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
        // Create new Booking
        $newBooking = Booking::create($request->all());

        // Retrieve the newly created Booking with the related Flight with airline and airports
        $query = Booking::query();
        $bookingWithFlight = $query->with(['flight.airline', 'flight.departureAirport', 'flight.arrivalAirport'])
            ->where('id', $newBooking->id)
            ->first();

        // Return the booked Flight
        return response()->json($bookingWithFlight);
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
        // Retrieve the old booking data with related flight and other relationships
        $query = Booking::query();
        $oldBooking = $query->with(['flight.airline', 'flight.departureAirport', 'flight.arrivalAirport'])
            ->where('id', $booking->id)
            ->first();

        // Delete the booking
        $booking->delete();

        // Return the old booking data as JSON
        return response()->json($oldBooking);
    }
}
