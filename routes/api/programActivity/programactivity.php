<?php
Route::group(['namespace' => 'ProgramActivity', 'middleware' => ['web', 'auth'], 'prefix' => 'programactivities', 'as' => 'programactivity.'], function () {
    //Route::post('store-attendance', 'ProgramActivityController@storeAttendance')->name('store_attendance');
});
