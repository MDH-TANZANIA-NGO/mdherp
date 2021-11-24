<?php
Route::group(['namespace' => 'Requisition\Travelling', 'middleware' => ['web', 'auth'], 'prefix' => 'travelling', 'as' => 'travelling.'], function () {
    Route::get('', 'RequestTravellingController@index')->name('index');
    Route::post('store', 'RequestTravellingController@store')->name('store');
    Route::get('create','RequestTravellingController@create')->name('create');


    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'RequestTravellingController@allDatatable')->name('all');
    });
});

