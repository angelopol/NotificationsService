<?php

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

Route::get('/notifications', 'NotificationsController@index');
Route::get('/notifications/pending', 'NotificationsController@IndexPending');
Route::get('/notifications/sent', 'NotificationsController@IndexSent');
Route::get('/notifications/failed', 'NotificationsController@IndexFailed');

Route::post('/notifications', 'NotificationsController@store');

Route::get('/notifications/{id}', 'NotificationsController@show');
Route::patch('/notifications/{id}', 'NotificationsController@update');
Route::delete('/notifications/{id}', 'NotificationsController@destroy');

Route::get('/notifications/{email}', 'NotificationsController@ShowUser');
Route::get('/notifications/{email}/pending', 'NotificationsController@ShowUserPending');
Route::get('/notifications/{email}/sent', 'NotificationsController@ShowUserSent');
Route::get('/notifications/{email}/failed', 'NotificationsController@ShowUserFailed');