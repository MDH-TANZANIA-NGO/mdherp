<?php
Route::group(['namespace' => 'JobOffer', 'middleware' => ['web', 'auth'], 'prefix' => 'job_offer', 'as' => 'job_offer.'], function () {
    Route::get('', 'JobOfferController@index')->name('index');
    Route::get('create', 'JobOfferController@create')->name('create');

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
