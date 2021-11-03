<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Api\Auth\AuthenticationController@login');


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    Route::post('attendance/store', 'Api\Attendance\AttendanceController@store');
    Route::get('{user}/attendances', 'Api\Attendance\AttendanceController@show');
    Route::post('/logout', 'Api\Auth\AuthenticationController@logout');
});
