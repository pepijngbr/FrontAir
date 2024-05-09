<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BaggageController;

Route::apiResource('users', UserController::class);
Route::apiResource('airports', AirportController::class);
Route::apiResource('flights', FlightController::class);
Route::apiResource('airlines', AirlineController::class);
Route::apiResource('tickets', TicketController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('baggages', BaggageController::class);
    // ->parameters(['baggages' => 'baggage']);
// Route::apiResource('commentaren', CommentaarController::class)
//               ->parameters(['commentaren' => 'commentaar']);
