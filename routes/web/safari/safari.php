<?php
Route::group(['namespace' => 'Safari', 'middleware' => ['web', 'auth'], 'prefix' => 'safari', 'as' => 'safari.'], function () {
    Route::get('', 'SafariController@index')->name('index');
    Route::get('{safariAdvance}/create', 'SafariController@create')->name('create');
    Route::get('{safariAdvance}/edit', 'SafariController@edit')->name('edit');
    Route::get('initiate', 'SafariController@initiate')->name('initiate');
    Route::post('store', 'SafariController@store')->name('store');
    Route::post('storeHotelReservation', 'SafariController@storeHotelReservation')->name('storeHotelReservation');
    Route::post('{uuid}/update', 'SafariController@update')->name('update');
    Route::get('{uuid}/removeHotel', 'SafariController@removeHotel')->name('removeHotel');
    Route::get('{uuid}/reserveHotel', 'SafariController@reserveHotel')->name('reserveHotel');
    Route::get('{safariAdvance}/show', 'SafariController@show')->name('show');

    Route::post('{uuid}/payment', 'SafariController@payment')->name('payment');


    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'SafariController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'SafariController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'SafariController@AccessApprovedDatatable')->name('approved');
            Route::get('saved', 'SafariController@AccessDatatable')->name('saved');
            Route::get('paid', 'SafariController@AccessPaidDatatable')->name('paid');
        });
    });
});

Route::group(['namespace' => 'Requisition', 'middleware' => ['web', 'auth'], 'prefix' => 'requisitions', 'as' => 'requisition.'], function () {

    Route::get('{requisition}/show', 'RequisitionController@show')->name('show');

});
