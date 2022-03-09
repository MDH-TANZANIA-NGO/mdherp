<?php
Route::group(['namespace' => 'Rate', 'middleware' => ['web', 'auth'], 'prefix' => 'rates', 'as' => 'rate.'], function () {
    Route::get('', 'RateController@index')->name('index');
    Route::get('submitted', 'RateController@show')->name('show');
    Route::get('submitted', 'RateController@store')->name('store');
    Route::get('approved', 'RateController@update')->name('update');
});

Route::group(['prefix' => 'datatables', 'as' => 'leave_report.'], function () {
    Route::get('', 'RateController@allDatatable')->name('all');
});
