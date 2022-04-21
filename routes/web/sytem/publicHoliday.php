<?php


Route::group(['namespace' => 'PublicHoliday', 'middleware' => ['web', 'auth'], 'prefix' => 'public_holiday', 'as' => 'public_holiday.'], function () {
    Route::get('', 'PublicHolidayController@index')->name('index');
    Route::get('create', 'PublicHolidayController@create')->name('create');
    Route::get('edit', 'PublicHolidayController@edit')->name('edit');
    Route::post('store', 'PublicHolidayController@store')->name('store');

});
