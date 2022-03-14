<?php
Route::group(['namespace' => 'GOfficer', 'middleware' => ['web', 'auth'], 'prefix' => 'government-officers', 'as' => 'g_officer.'], function () {
    Route::get('', 'GOfficerController@index')->name('index');
    Route::post('store', 'GOfficerController@store')->name('store');
    Route::get('{uuid}/show', 'GOfficerController@show')->name('show');
    Route::put('{uuid}/update', 'GOfficerController@update')->name('update');
    Route::put('{uuid}/activate', 'GOfficerController@activate')->name('activate');
    Route::post('import', 'GOfficerController@import')->name('import');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'GOfficerController@allDatatable')->name('all');
    });
});
