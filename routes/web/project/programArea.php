<?php
Route::group(['namespace' => 'Project', 'middleware' => ['web', 'auth'], 'prefix' => 'program-area', 'as' => 'program_area.'], function () {
    Route::get('', 'ProgramAreaController@index')->name('index');
    Route::post('store', 'ProgramAreaController@store')->name('store');
    Route::get('{project}/show', 'ProgramAreaController@show')->name('show');
    Route::put('{project}/update', 'ProgramAreaController@update')->name('update');
    Route::put('{project}/activate', 'ProgramAreaController@activate')->name('activate');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'ProgramAreaController@allDatatable')->name('all');
    });
});
