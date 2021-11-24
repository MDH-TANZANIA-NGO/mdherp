<?php
Route::group(['namespace' => 'Requisition\Training', 'middleware' => ['web', 'auth'], 'prefix' => 'training', 'as' => 'training.'], function () {
    Route::get('', 'trainingController@index')->name('index');
    Route::post('store', 'trainingController@store')->name('store');
    Route::get('{uuid}/show', 'trainingController@show')->name('show');
    Route::put('{uuid}/update', 'trainingController@update')->name('update');
    Route::get('create','trainingController@create')->name('create');


    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'trainingController@allDatatable')->name('all');
    });
});

