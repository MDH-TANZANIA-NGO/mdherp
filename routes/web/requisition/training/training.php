<?php
Route::group(['namespace' => 'Requisition\Training', 'middleware' => ['web', 'auth'], 'prefix' => 'training', 'as' => 'training.'], function () {
    Route::get('', 'RequestTrainingController@index')->name('index');
    Route::post('store', 'RequestTrainingController@store')->name('store');
    Route::get('{uuid}/show', 'RequestTrainingController@show')->name('show');
    Route::put('{uuid}/update', 'RequestTrainingController@update')->name('update');
    Route::get('create','RequestTrainingController@create')->name('create');


    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'RequestTrainingController@allDatatable')->name('all');
    });
});

