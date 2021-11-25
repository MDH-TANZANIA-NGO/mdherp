<?php
Route::group(['namespace' => 'Requisition\Travelling', 'middleware' => ['web', 'auth'], 'prefix' => 'travelling', 'as' => 'travelling.'], function () {
    Route::get('', 'RequestTravellingCostController@index')->name('index');
    Route::post('requisitions/{requisition}/store', 'RequestTravellingCostController@store')->name('store');
    Route::get('create','RequestTravellingCostController@create')->name('create');


    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'RequestTravellingCostController@allDatatable')->name('all');
    });
});

