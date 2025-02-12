<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConcertController;
Route::apiResource('concerts', ConcertController::class);


use App\Http\Controllers\VenueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;


Route::apiResource('venues', VenueController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('reservations', ReservationController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});