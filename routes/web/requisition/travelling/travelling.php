<?php
Route::group(['namespace' => 'Requisition\Travelling', 'middleware' => ['web', 'auth'], 'prefix' => 'travelling', 'as' => 'travelling.'], function () {
    Route::get('', 'travellingController@index')->name('index');
    Route::post('store', 'travellingController@store')->name('store');
    Route::get('create','travellingController@create')->name('create');

});
