<?php
Route::group(['namespace' => 'JobOffer', 'middleware' => ['web', 'auth'], 'prefix' => 'job_offer', 'as' => 'job_offer.'], function () {
    Route::get('', 'JobOfferContorller@index')->name('index');


    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'JobOfferContorller@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'JobOfferContorller@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'JobOfferContorller@AccessApprovedDatatable')->name('approved');
        });

    });
});
