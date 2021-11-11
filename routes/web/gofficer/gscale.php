<?php
Route::group(['namespace' => 'GOfficer', 'middleware' => ['web', 'auth'], 'prefix' => 'government-scales', 'as' => 'g_scale.'], function () {
    Route::get('', 'GScaleController@index')->name('index');
    Route::post('store', 'GScaleController@store')->name('store');
    Route::get('{uuid}/show', 'GScaleController@show')->name('show');
    Route::put('{uuid}/update', 'GScaleController@update')->name('update');
    Route::put('{uuid}/activate', 'GScaleController@activate')->name('activate');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'GScaleController@allDatatable')->name('all');
    });
});
