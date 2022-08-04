<?php
Route::group(['namespace' => 'Requisition\Favourite', 'middleware' => ['web', 'auth'], 'prefix' => 'favourite', 'as' => 'favourite.'], function () {
    Route::get('', 'FavouritesController@index')->name('index');
    Route::post('store', 'FavouritesController@store')->name('store');

    /**
     * Datatables
     */
//    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
//        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
//            Route::get('processing', 'RequisitionController@AccessProcessingDatatable')->name('processing');
//            Route::get('rejected', 'RequisitionController@AccessRejectedDatatable')->name('rejected');
//            Route::get('denied', 'RequisitionController@AccessDeniedDatatable')->name('denied');
//            Route::get('approved', 'RequisitionController@AccessApprovedDatatable')->name('approved');
//            Route::get('saved', 'RequisitionController@AccessSavedDatatable')->name('saved');
//            Route::get('paid', 'RequisitionController@AccessPaidDatatable')->name('paid');
//        });
//
//        Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
//            Route::get('all_submitted', 'RequisitionController@AllRequisitionsDatatable')->name('all_submitted');
//        });
//    });
});
