<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\BookingController;

Route::apiResource('users', UserController::class);
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('reset-password', [UserController::class, 'resetPassword']);
Route::get('users/{user}/bookings', [UserController::class, 'showBookings']);
Route::get('users/{user}/bookings/{booking}', [UserController::class, 'showBooking']);

Route::apiResource('airports', AirportController::class);

Route::apiResource('flights', FlightController::class);

Route::apiResource('airlines', AirlineController::class);

Route::apiResource('bookings', BookingController::class);
