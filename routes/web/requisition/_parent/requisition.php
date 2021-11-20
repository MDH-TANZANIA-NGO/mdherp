<?php
Route::group(['namespace' => 'Requisition', 'middleware' => ['web', 'auth'], 'prefix' => 'requisitions', 'as' => 'requisition.'], function () {
    Route::get('', 'RequisitionController@index')->name('index');
    Route::get('create', 'RequisitionController@create')->name('create');
    Route::post('store', 'RequisitionController@store')->name('store');
    Route::get('{activity}/show', 'RequisitionController@show')->name('show');
    Route::get('{activity}/show/{uuid}/fiscal-year', 'RequisitionController@show')->name('show_fiscal_year');
    Route::put('{activity}/update', 'RequisitionController@update')->name('update');
    Route::put('{activity}/activate', 'RequisitionController@activate')->name('activate');
    Route::put('{activity}/activate', 'RequisitionController@activate')->name('activate');
    Route::get('detailed', 'RequisitionController@detailed')->name('detailed');
    Route::get('get-json', 'RequisitionController@getResultsJson')->name('get_json');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'RequisitionController@allDatatable')->name('all');
    });
});
