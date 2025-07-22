<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\InvoiceProductController;
use App\Http\Controllers\ProductRequestController;
use App\Http\Controllers\ActivityEventController;
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessagekController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SecurityEventController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UserController;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


    Route::get('events', [EventController::class, 'index']);
    Route::get('activityEvent', [ActivityEventController::class, 'index']);
    Route::get('eventUser',[EventUserController::class, 'index']);
    Route::get('feedback',[FeedbackController::class, 'index']);
    Route::get('message',[MessageController::class, 'index']);
    Route::get('notifications',[NotificationController::class, 'index']);
    Route::get('payment',[PaymentController::class, 'index']);
    Route::get('securityEvent',[SecurityEventController::class, 'index']);
    Route::get('service',[ServiceController::class, 'index']);
    Route::get('support',[SupportController::class, 'index']);
    Route::get('user',[UserController::class, 'index']);
