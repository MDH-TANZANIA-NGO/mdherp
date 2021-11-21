<?php
Route::group(['namespace' => 'Requisition\Training', 'middleware' => ['web', 'auth'], 'prefix' => 'training', 'as' => 'training.'], function () {
    Route::get('', 'trainingController@index')->name('index');
    Route::post('store', 'trainingController@store')->name('store');
    Route::get('create','trainingController@create')->name('create');


    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'trainingController@allDatatable')->name('all');
    });
});

