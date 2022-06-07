<?php
Route::group(['namespace' => 'Requisition\Travelling', 'middleware' => ['web', 'auth'], 'prefix' => 'travelling', 'as' => 'travelling.'], function () {
    Route::get('', 'RequestTravellingCostController@index')->name('index');
    Route::post('requisitions/{requisition}/store', 'RequestTravellingCostController@store')->name('store');
    Route::get('create','RequestTravellingCostController@create')->name('create');
    Route::get('{uuid}/edit','RequestTravellingCostController@edit')->name('edit');
    Route::get('{uuid}/delete','RequestTravellingCostController@delete')->name('delete');
    Route::post('{uuid}/update', 'RequestTravellingCostController@update')->name('update');

    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'RequestTravellingCostController@allDatatable')->name('all');
    });
});

