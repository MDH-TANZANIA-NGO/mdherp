<?php
Route::group(['namespace' => 'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'hirerequisition', 'as' => 'hirerequisition.'], function () {
    Route::get('', 'HireRequisitionController@index')->name('index');
    Route::get('create', 'HireRequisitionController@create')->name('create');
    Route::post('store', 'HireRequisitionController@store')->name('store');
    Route::get('{hirerequisition}/show', 'HireRequisitionController@show')->name('show');
    Route::get('{hirerequisition}/edit', 'HireRequisitionController@edit')->name('edit');
    Route::put('{hirerequisition}/update', 'HireRequisitionController@update')->name('update');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'HireRequisitionController@AccessProcessingDatatable')->name('processing');
            Route::get('returned', 'HireRequisitionController@AccessDeniedDatatable')->name('returned');
            Route::get('rejected', 'HireRequisitionController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'HireRequisitionController@AccessProvedDatatable')->name('approved');
        });
    });
});

Route::group(['namespace' => 'HumanResource', 'middleware' => 'web'], function(){
    Route::get('vacancies', 'HireRequisitionController@getVacancies')->name('vacancies');
    Route::get('{hirerequisition}/vacancy', 'HireRequisitionController@getVacancy')->name('vacancy');
});
