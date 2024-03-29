<?php
Route::group(['namespace' => 'Requisition', 'middleware' => ['web', 'auth'], 'prefix' => 'requisitions', 'as' => 'requisition.'], function () {
    Route::get('', 'RequisitionController@index')->name('index');
    Route::get('create', 'RequisitionController@create')->name('create');
    Route::get('{requisition}/addDescription', 'RequisitionController@addDescription')->name('addDescription');
    Route::post('store', 'RequisitionController@store')->name('store');
    Route::post('{requisition}/description', 'RequisitionController@description')->name('description');
    Route::get('{requisition}/initiate', 'RequisitionController@initiate')->name('initiate');
    Route::post('{requisition}/submit', 'RequisitionController@submit')->name('submit');
    Route::get('{requisition}/show', 'RequisitionController@show')->name('show');
    Route::put('{activity}/update', 'RequisitionController@update')->name('update');
    Route::get('{requisition}/updateActualAmount', 'RequisitionController@updateActualAmount')->name('updateActualAmount');
    Route::get('get-json', 'RequisitionController@getResultsJson')->name('get_json');
    Route::get('all_requisitions', 'RequisitionController@allRequisitions')->name('all_requisitions');
    Route::get('training_cost_favourite', 'RequisitionController@buildFromRequisitionTrainingCost')->name('training_cost_favourite');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'RequisitionController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'RequisitionController@AccessRejectedDatatable')->name('rejected');
            Route::get('denied', 'RequisitionController@AccessDeniedDatatable')->name('denied');
            Route::get('approved', 'RequisitionController@AccessApprovedDatatable')->name('approved');
            Route::get('saved', 'RequisitionController@AccessSavedDatatable')->name('saved');
            Route::get('paid', 'RequisitionController@AccessPaidDatatable')->name('paid');
        });

        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
            Route::get('all_submitted', 'RequisitionController@AllRequisitionsDatatable')->name('all_submitted');
        });
    });
});
