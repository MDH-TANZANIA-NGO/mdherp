<?php
Route::group(['namespace' => 'Project', 'middleware' => ['web', 'auth'], 'prefix' => 'projects', 'as' => 'project.'], function () {
    Route::get('', 'ProjectController@index')->name('index');
    Route::post('store', 'ProjectController@store')->name('store');
    Route::get('{project}/show', 'ProjectController@show')->name('show');
    Route::put('{project}/update', 'ProjectController@update')->name('update');
    Route::put('{project}/activate', 'ProjectController@activate')->name('activate');
    Route::get('{id}/region', 'ProjectController@byRegion')->name('by_region');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'ProjectController@allDatatable')->name('all');
    });
});
