<?php
Route::group(['namespace' => 'Project', 'middleware' => ['web', 'auth'], 'prefix' => 'output-units', 'as' => 'output_unit.'], function () {
    Route::get('', 'OutputUnitController@index')->name('index');
    Route::post('store', 'OutputUnitController@store')->name('store');
    Route::get('{uuid}/show', 'OutputUnitController@show')->name('show');
    Route::put('{uuid}/update', 'OutputUnitController@update')->name('update');
    Route::put('{uuid}/activate', 'OutputUnitController@activate')->name('activate');
    Route::get('/region', 'OutputUnitController@byRegion')->name('by_region');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'OutputUnitController@allDatatable')->name('all');
    });
});
