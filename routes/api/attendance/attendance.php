<?php

Route::group([ 'namespace' => 'Attendance', 'prefix' => 'attendance',  'as' => 'attendance.'], function() {
    Route::post('store', 'AttendanceController@store')->name("store");

    /*Hotspot*/
    Route::group([ 'prefix' => 'hotspot',  'as' => 'hotspot.'], function() {
        Route::get('{hotspot}/show', 'AttendanceController@allByHotspot')->name("all_by_hotspot");
    });

});
