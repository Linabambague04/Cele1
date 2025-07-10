<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\InvoiceProductController;
use App\Http\Controllers\ProductRequestController;
use App\Http\Controllers\ActivityEventController;
use App\Models\ActivityEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('events', [EventController::class, 'index']);
    Route::get('activityEvent', [ActivityEventController::class, 'index']);
});