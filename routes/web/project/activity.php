<?php
Route::group(['namespace' => 'Project', 'middleware' => ['web', 'auth'], 'prefix' => 'activities', 'as' => 'activity.'], function () {
    Route::get('', 'ActivityController@index')->name('index');
    Route::post('store', 'ActivityController@store')->name('store');
    Route::get('{activity}/show', 'ActivityController@show')->name('show');
    Route::get('{activity}/show/{uuid}/fiscal-year', 'ActivityController@show')->name('show_fiscal_year');
    Route::put('{activity}/update', 'ActivityController@update')->name('update');
    Route::put('{activity}/activate', 'ActivityController@activate')->name('activate');
    Route::get('json-filer', 'ActivityController@getActivitiesJson')->name('json_filter');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'ActivityController@allDatatable')->name('all');
    });
});
