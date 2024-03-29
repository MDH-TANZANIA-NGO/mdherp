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
Route::post('g_officer/{g_officer}/refresh', 'Api\Auth\LoginController@refresh');
Route::post('g_officer/{g_officer}/fingerprint/update', 'Api\MDHData\GOfficerController@update');
Route::post('g_officer/hotspot/store', 'Api\Hotspot\HotspotController@store')->name("store");
Route::post('g_officer/attendance/store', 'Api\Attendance\ActivityAttendanceController@store')->name("attendance.store");
Route::post('logout', 'Api\Auth\LoginController@logout');

Route::group( ['prefix' => 'g_officer','middleware' => ['auth:g_officer-api'] ],function(){
    
    Route::post('hts/store','Api\MDHData\HTSController@store');
    Route::post('covid/store', 'Api\MDHData\CovidController@store');

    Route::get('{g_officer}/{facility}/hts/reports', 'Api\MDHData\HTSController@getGOfficerHTS');
    Route::get('{g_officer}/{facility}/covid/reports', 'Api\MDHData\CovidController@getGOfficerCovid');

    Route::post('facility/hts/filter', 'Api\MDHData\HTSController@filterReportsByDate');
    Route::post('facility/covid/filter', 'Api\MDHData\CovidController@filterReportsByDate');

//    ProgramActivityAttendance
    Route::get('valid-activities', 'Api\ProgramActivity\ProgramActivityController@getAllValidActivities');
    Route::post('store-attendance', 'Api\ProgramActivity\ProgramActivityController@storeAttendance');
    Route::post('submit-activity-number', 'Api\ProgramActivity\ProgramActivityController@submitActivityNumberGetDetails');

    // Retention
    Route::post('retention/store', 'Api\MDHData\RetentionController@store');
    Route::get('{g_officer}/{facility}/retention/reports/', 'Api\MDHData\RetentionController@getGOfficerRetentions');
    Route::post('facility/retention/filter', 'Api\MDHData\RetentionController@filterReportsByDate');

    // MCH
    Route::post('mch/store', 'Api\MDHData\MchController@store');
    Route::get('{g_officer}/{facility}/mch/reports/', 'Api\MDHData\MchController@getGOfficerMchs');
    Route::post('facility/mch/filter', 'Api\MDHData\MchController@filterReportsByDate');
});
