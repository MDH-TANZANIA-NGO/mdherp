<?php
Route::group(['namespace' => 'Retirement', 'middleware' => ['web', 'auth'], 'prefix' => 'retirement', 'as' => 'retirement.'], function () {
    Route::get('', 'RetirementController@index')->name('index');
    Route::get('{retirement}/create', 'RetirementController@create')->name('create');
    Route::get('{retirement}/edit', 'RetirementController@edit')->name('edit');
    Route::get('{retirement}/saved', 'RetirementController@saved')->name('saved');
    Route::post('store', 'RetirementController@store')->name('store');
    Route::post('{uuid}/update', 'RetirementController@update')->name('update');
    Route::post('{uuid}/refurbish', 'RetirementController@refurbish')->name('refurbish');
    Route::get('{retirement}/show', 'RetirementController@show')->name('show');
    Route::get('initiate', 'RetirementController@initiate')->name('initiate');
    Route::get('back', 'RetirementController@goback')->name('back');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'RetirementController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'RetirementController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'RetirementController@AccessApprovedDatatable')->name('approved');
            Route::get('saved', 'RetirementController@AccessSavedDatatable')->name('saved');
//            Route::get('paid', 'RetirementController@AccesssDatatable')->name('paid');
        });
    });

});
