<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Returns all Bookings.
     *
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        return Booking::all();
    }

    /**
     * Create a new Booking.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
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

    /**
     * Returns a specific Booking.
     *
     * @param Booking $booking
     * @return Booking
     */
    public function show(Booking $booking): Booking
    {
        return $booking;
    }

    /**
     * Updates a Booking.
     *
     * @param Request $request
     * @param Booking $booking
     * @return Booking
     */
    public function update(Request $request, Booking $booking): Booking
    {
        $booking->update($request->all());
        return $booking;
    }

    /**
     * Destroys a Booking and returns the booking before it's deleted.
     *
     * @param Booking $booking
     * @return JsonResponse
     */
    public function destroy(Booking $booking): JsonResponse
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
