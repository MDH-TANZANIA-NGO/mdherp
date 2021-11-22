<?php
Route::group(['namespace' => 'Requisition', 'middleware' => ['web', 'auth'], 'prefix' => 'requisitions', 'as' => 'requisition.'], function () {
    Route::get('', 'RequisitionController@index')->name('index');
    Route::get('create', 'RequisitionController@create')->name('create');
    Route::post('store', 'RequisitionController@store')->name('store');
    Route::get('{requisition}/initiate', 'RequisitionController@initiate')->name('initiate');
    Route::post('{requisition}/submit', 'RequisitionController@submit')->name('submit');
    Route::get('{requisition}/show', 'RequisitionController@show')->name('show');
    Route::put('{activity}/update', 'RequisitionController@update')->name('update');

    Route::get('get-json', 'RequisitionController@getResultsJson')->name('get_json');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('processing', 'RequisitionController@processingDatatable')->name('processing');
    });
});
