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

Route::post('login', 'Api\Auth\LoginController@login');

Route::post('verify-token', 'Api\UserLoginToken\UserLoginTokenController@verifyToken')->name('verifyToken');


//Route::group(['middleware' => 'auth:api'], function () {
////    Route::get('/user', function(Request $request) {
////        return $request->user();
////    });
//    Route::post('attendance/store', 'Api\Attendance\AttendanceController@store');
//    Route::get('{user}/attendances', 'Api\Attendance\AttendanceController@show');
//    Route::post('/logout', 'Api\Auth\LoginController@logout');
//});

// Route::group(['prefix' => 'auth', 'namespace' => 'Api'],fu
// includeRouteFiles(__DIR__.'/api/');
// Route::group(['namespace' => 'Recruitment\Advertisement', 'middleware' => ['web', 'auth'], 'prefix' => 'advertisement', 'as' => 'advertisement'], function () {
//     Route::get('advertisement', 'AdvertisementController@index')->name('index');
// });

Route::get('advertisement', 'Api\Recruitment\Advertisement\AdvertisementController@index');
Route::get('advertisements', 'Api\Recruitment\Advertisement\AdvertisementController@getJobs');
Route::group(['prefix' => 'auth', 'namespace' => 'Api'],
    function(){
        // Route::post('login', 'Auth\LoginController@login');

        Route::post('refresh', 'Auth\LoginController@refresh');
        Route::post('g_officer/store', 'MDHData\GOfficerController@store')->name('g_officer-store');
        Route::get('{g_officer}/facilities', 'MDHData\GOfficerController@show')->name('g_officer-facilities');
        Route::post('g_officer/facilities/assign', 'MDHData\FacilityGOfficerController@assignUserToFacility')->name('g_officer-assign-facility');
        Route::group([
            'middleware' => ['auth:user-api']
        ], function() {
            Route::post('logout', 'Auth\LoginController@logout');

            Route::post('ward/store', 'MDHData\WardController@store');
            Route::post('facility/store', 'MDHData\FacilityController@store')->name('facility-store');
            includeRouteFiles(__DIR__.'/api/');
        });
    });
