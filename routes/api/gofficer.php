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

Route::post('g_officer/login', 'Api\Auth\LoginController@gOfficerLogin')->name('gOfficerLogin');
Route::group( ['prefix' => 'g_officer','middleware' => ['auth:g_officer-api'] ],function(){
    Route::post('logout', 'Api\Auth\LoginController@logout');

    Route::post('hts/store','Api\MDHData\HTSController@store');
    Route::post('covid/store', 'Api\MDHData\CovidController@store');

//    ProgramActivityAttendance
    Route::post('store-attendance', 'Api\ProgramActivity\ProgramActivityController@storeAttendance');
});
