<?php
Route::group(['namespace' => 'Requisition\Travelling', 'middleware' => ['web', 'auth'], 'prefix' => 'travelling', 'as' => 'travelling.'], function () {
    Route::get('', 'travellingController@index')->name('index');
    Route::post('store', 'travellingController@storeRates')->name('store');

});
