<?php
Route::group(['namespace' => 'GOfficer', 'middleware' => ['web', 'auth'], 'prefix' => 'government-officers', 'as' => 'g_officer.'], function () {
    Route::get('', 'GOfficerController@index')->name('index');
    Route::post('store', 'GOfficerController@store')->name('store');
    Route::get('{uuid}/show', 'GOfficerController@show')->name('show');
    Route::put('{uuid}/update', 'GOfficerController@update')->name('update');
    Route::put('{uuid}/activate', 'GOfficerController@activate')->name('activate');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'GOfficerController@allDatatable')->name('all');
    });
});
