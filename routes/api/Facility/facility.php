<?php
Route::group(['namespace' => 'Facility', 'middleware' => ['web', 'auth'], 'prefix' => 'facilities', 'as' => 'facility.'], function () {
    Route::post('ward/store', 'WardController@store')->name('ward-store');
});
