<?php
Route::group(['namespace' => 'Project', 'middleware' => ['web', 'auth'], 'prefix' => 'activities', 'as' => 'activity.'], function () {
    Route::get('', 'ActivityController@index')->name('index');
    Route::post('store', 'ActivityController@store')->name('store');
    Route::get('{activity}/show', 'ActivityController@show')->name('show');
    Route::put('{activity}/update', 'ActivityController@update')->name('update');
    Route::put('{activity}/activate', 'ActivityController@activate')->name('activate');
    Route::put('{activity}/activate', 'ActivityController@activate')->name('activate');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'ActivityController@allDatatable')->name('all');
    });
});
