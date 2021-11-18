<?php
Route::group(['namespace' => 'MdhRates', 'middleware' => ['web', 'auth'], 'prefix' => 'mdh-rates', 'as' => 'mdh-rates.'], function () {
    Route::get('', 'mdhRatesController@index')->name('index');
    Route::post('store', 'mdhRatesController@storeRates')->name('store');
    Route::get('for-rates', 'mdhRatesController@getForDuallist')->name('mdh-rates');

});

