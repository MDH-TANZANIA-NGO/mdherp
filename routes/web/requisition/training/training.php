<?php
Route::group(['namespace' => 'Requisition\Training', 'middleware' => ['web', 'auth'], 'prefix' => 'training', 'as' => 'training.'], function () {
    Route::get('', 'trainingController@index')->name('index');
    Route::post('store', 'trainingController@storeRates')->name('store');

});
