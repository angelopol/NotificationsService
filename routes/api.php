<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationsController;

Route::get('/notifications', [NotificationsController::class, 'index']);
Route::get('/notifications/pending', [NotificationsController::class, 'IndexPending']);
Route::get('/notifications/sent', [NotificationsController::class, 'IndexSent']);
Route::get('/notifications/failed', [NotificationsController::class, 'IndexFailed']);

Route::post('/notifications', [NotificationsController::class, 'store']);

Route::get('/notifications/{id}', [NotificationsController::class, 'show']);
Route::patch('/notifications/{id}', [NotificationsController::class, 'update']);
Route::delete('/notifications/{id}', [NotificationsController::class, 'destroy']);

Route::get('/notifications/user/{email}', [NotificationsController::class, 'ShowUser']);
Route::get('/notifications/user/{email}/pending', [NotificationsController::class, 'ShowUserPending']);
Route::get('/notifications/user/{email}/sent', [NotificationsController::class, 'ShowUserSent']);
Route::get('/notifications/user/{email}/failed', [NotificationsController::class, 'ShowUserFailed']);