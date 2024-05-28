<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BaggageController;

Route::apiResource('users', UserController::class);
Route::get('users/{user}/tickets', [UserController::class, 'showTickets']);
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('reset-password', [UserController::class, 'resetPassword']);

Route::apiResource('airports', AirportController::class);

Route::apiResource('flights', FlightController::class);

Route::apiResource('airlines', AirlineController::class);

Route::apiResource('tickets', TicketController::class);

Route::apiResource('baggages', BaggageController::class);

