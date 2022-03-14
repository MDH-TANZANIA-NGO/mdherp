<?php
Route::group(['namespace' => 'Project', 'middleware' => ['web', 'auth'], 'prefix' => 'program-area', 'as' => 'program_area.'], function () {
    Route::get('', 'ProgramAreaController@index')->name('index');
    Route::post('store', 'ProgramAreaController@store')->name('store');
    Route::get('{uuid}/show', 'ProgramAreaController@show')->name('show');
    Route::put('{uuid}/update', 'ProgramAreaController@update')->name('update');
    Route::put('{uuid}/activate', 'ProgramAreaController@activate')->name('activate');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'ProgramAreaController@allDatatable')->name('all');
    });
});
