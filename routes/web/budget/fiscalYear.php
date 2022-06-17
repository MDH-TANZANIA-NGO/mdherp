<?php
Route::group(['namespace' => 'Budget', 'middleware' => ['web', 'auth'], 'prefix' => 'fiscal-years', 'as' => 'fiscal_year.'], function () {
    Route::get('', 'FiscalYearController@index')->name('index');
    Route::post('store', 'FiscalYearController@store')->name('store');
    Route::get('{uuid}/show', 'FiscalYearController@show')->name('show');
    Route::put('{uuid}/update', 'FiscalYearController@update')->name('update');
    Route::put('{uuid}/activate', 'FiscalYearController@activate')->name('activate');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'FiscalYearController@allDatatable')->name('all');
    });
});
