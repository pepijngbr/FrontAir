<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Returns all Users (if needed: limit & offset).
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User
     */
    public function store(Request $request)
    {
        // TODO: validate request
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
     * @param  \App\Models\User  $user
     * @return \App\Models\User
     */
    public function show(User $user)
    {
        $user = User::find($user);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return $user;
    }

    /**
     * Updates a specific User.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \App\Models\User
     */
    public function update(Request $request, User $user)
    {
        dd($request->all());

        $user->update($request->all());
        return $user;
    }

    /**
     * Deletes a specific User.
     * 
     * @param  \App\Models\User  $user
     */
    public function destroy(User $user)
    {
        $user->delete();
    }

    /**
     * Registers a new User.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User
     */
    public function register(Request $request)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User
     */
    public function login(Request $request)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User
     */
    public function resetPassword(Request $request)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Booking
     */
    public function showBookings(Request $request)
    {
        $user = User::find($request->user);
        if (!$user) return response()->json(['message' => 'A valid User ID is required'], 400);
        else {
            $bookings = User::find($request->user)->bookings();
            if (count($bookings->get()) == 0) {
                return response()->json(['message' => 'No bookings found'], 404);
            } else {
                return [
                    'user' => $user->makeHidden(['id']),
                    'bookings' => $bookings->with('flight.departureAirport', 'flight.arrivalAirport', 'flight.airline')->get()
                    // ->makeHidden(['flight_id', 'user_id', 'booking_id'])
                ];
            }
        }
    }
}
