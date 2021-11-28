<?php
Route::group(['namespace' => 'Requisition\Training', 'middleware' => ['web', 'auth'], 'prefix' => 'training', 'as' => 'training.'], function () {
    Route::get('', 'RequestTrainingCostController@index')->name('index');
    Route::post('requisitions/{requisition}/store', 'RequestTrainingCostController@store')->name('store');
    Route::get('{uuid}/show', 'RequestTrainingCostController@show')->name('show');
    Route::put('{uuid}/update', 'RequestTrainingCostController@update')->name('update');
    Route::get('create','RequestTrainingCostController@create')->name('create');


    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'RequestTrainingCostController@allDatatable')->name('all');
    });
});
