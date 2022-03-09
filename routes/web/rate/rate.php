<?php
Route::group(['namespace' => 'Rate', 'middleware' => ['web', 'auth'], 'prefix' => 'rates', 'as' => 'rate.'], function () {
    Route::get('', 'RateController@index')->name('index');
    Route::get('{rate}/show', 'RateController@show')->name('show');
    Route::post('store', 'RateController@store')->name('store');
    Route::put('{rate}/update', 'RateController@update')->name('update');

    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'RateController@allDatatable')->name('all');
    });

});
