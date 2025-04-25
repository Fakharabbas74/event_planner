<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign_in');
Route::get('/get-all-events', [EventController::class, 'getAllEvents']);
Route::post('/filter-events', [EventController::class, 'filterEvents']);
Route::post('/search-events', [EventController::class, 'searchEvents']);
Route::get('/get-event-types', [EventController::class, 'getEventTypes']);
Route::post('/search-by-type', [EventController::class, 'searchByType']);
Route::post('/search-by-date', [EventController::class, 'searchByDate']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::get('/sign-out', [AuthController::class, 'logout'])->name('sign_out');

    //Events
    Route::put('/edit-event/{id}', [EventController::class, 'updateEvent']);
    Route::delete('/delete-event/{id}', [EventController::class, 'deleteEvent']);
    Route::post('/create-event', [EventController::class, 'createEvent']);
});