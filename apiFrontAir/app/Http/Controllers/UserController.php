<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Returns all Users (if needed: limit & offset).
     *
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        $limit = $request->input('limit');
        $offset = $request->input('offset') ?? 0;

        if ($limit && $limit > 1 && $offset >= 0) {
            return User::take($limit)->skip($offset)->get();
        }

        return User::all();
    }

    /**
     * Creates a new User.
     *
     * @param Request $request
     * @return User
     */
    public function store(Request $request): User
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]);
        return User::create($request->all());
    }

    /**
     * Returns a specific User.
     *
     * @param User $user
     * @return User
     */
    public function show(User $user): User
    {
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return $user;
    }

    /**
     * Updates a specific User.
     *
     * @param Request $request
     * @param User $user
     * @return User
     */
    public function update(Request $request, User $user): User
    {
        $user->update($request->all());
        return $user;
    }

    /**
     * Deletes a specific User.
     *
     * @param User $user
     */
    public function destroy(User $user): void
    {
        $user->delete();
    }

    /**
     * Registers a new User.
     *
     * @param Request $request
     * @return User
     */
    public function register(Request $request): User
    {
        $user = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]);
        $user['password'] = bcrypt($user['password']);
        return User::create($user);
    }

    /**
     * Logs in a User.
     *
     * @param Request $request
     * @return User
     */
    public function login(Request $request): User
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $user;
    }

    /**
     * Resets the password of a User.
     *
     * @param Request $request
     * @return User
     */
    public function resetPassword(Request $request): User
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->password = bcrypt($credentials['password']);
        $user->save();
        return $user;
    }


    /**
     * Returns the entire User and the Bookings of the user including the flight information, airports & airline
     *
     * @param Request $request
     * @return array|JsonResponse
     */
    public function showBookings(Request $request): JsonResponse|array
    {
        $user = User::find($request->user);
        if (!$user) return response()->json(['message' => 'A valid User ID is required'], 400);
        else {
            $bookings = User::find($request->user)->bookings();
            if (count($bookings->get()) == 0) {
                return response()->json(['message' => 'No bookings found'], 404);
            } else {
                $sortField = $request->input('sort_by');
                $sortOrder = $request->input('sort_order') ?? 'asc';
                if ($sortField) {
                    $bookings->orderBy($sortField, $sortOrder);
                }

                return [
                    'user' => $user->makeHidden(['id']),
                    'bookings' => $bookings->with('flight.departureAirport', 'flight.arrivalAirport', 'flight.airline')->get()
                    // ->makeHidden(['flight_id', 'user_id', 'booking_id'])
                ];
            }
        }
    }

    /**
     * Returns a specific booking with validation
     *
     * @param Request $request
     * @return Collection|JsonResponse|array
     */
    public function showBooking(Request $request): Collection|JsonResponse|array
    {
        $query = Booking::query();
        $query->find($request->booking);
        $booking = Booking::find($request->booking);
        if (!$booking) return response()->json(['message' => 'Booking not found'], 404);

        // Validate if the user ID from the request is equal to the user ID associated with the booking
        if ((int)$request->user !== $booking->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $query->with(['user', 'flight.airline', 'flight.departureAirport', 'flight.arrivalAirport'])->get();
    }
}
