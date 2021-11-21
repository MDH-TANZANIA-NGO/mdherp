<?php
Route::group(['namespace' => 'MdhRates', 'middleware' => ['web', 'auth'], 'prefix' => 'mdh-rates', 'as' => 'mdh-rates.'], function () {
    Route::get('', 'mdhRatesController@index')->name('index');
    Route::post('store', 'mdhRatesController@storeRates')->name('store');
    Route::get('for-rates', 'mdhRatesController@getRegions')->name('mdh-rates');
    Route::post('assign-rates', 'mdhRatesController@assignRate')->name('assign');

});

