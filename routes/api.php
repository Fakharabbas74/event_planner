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

Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign_in');

// Protected Route For Admin Panel
Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::get('/sign-out', [AuthController::class, 'signOut'])->name('sign_out');

    //Events
    Route::put('/edit-event/{id}', [EventController::class, 'updateEvent']);
    Route::delete('/delete-event/{id}', [EventController::class, 'deleteEvent']);
    Route::post('/create-event', [EventController::class, 'createEvent']);
});

// Public Routes For Website
Route::get('/get-all-events', [EventController::class, 'getAllEvents']);
Route::post('/filter-events', [EventController::class, 'filterEvents']);
Route::post('/search-events', [EventController::class, 'searchEvents']);
Route::get('/get-event-categories', [EventController::class, 'getEventCategories']);
Route::post('/search-by-category', [EventController::class, 'searchByCategory']);
Route::post('/search-by-date', [EventController::class, 'searchByDate']);
