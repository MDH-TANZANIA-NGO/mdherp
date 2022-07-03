<?php
Route::group(['namespace' => 'JobOffer', 'middleware' => ['web', 'auth'], 'prefix' => 'job_offer', 'as' => 'job_offer.'], function () {
    Route::get('', 'JobOfferController@index')->name('index');
    Route::get('initiate', 'JobOfferController@initiate')->name('initiate');
    Route::get('create', 'JobOfferController@create')->name('create');
    Route::get('{uuid}/edit', 'JobOfferController@edit')->name('edit');
    Route::post('store', 'JobOfferController@store')->name('store');
    Route::put('{uuid}/update', 'JobOfferController@update')->name('update');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'JobOfferController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'JobOfferController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'JobOfferController@AccessApprovedDatatable')->name('approved');
        });

    });
});
