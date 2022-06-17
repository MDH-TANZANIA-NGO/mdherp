<?php
//Route::group(['namespace' => 'Recruitment', 'middleware' => ['web', 'auth'], 'prefix' => 'recruitments', 'as' => 'listing.'], function () {
//
//   Route::get('', 'HireRequestController@index')->name('index');
//   Route::get('create','HireRequestController@create')->name('create');
//
//    Route::get('pending', 'HireRequestController@pending')->name('pending');
//    Route::post('approve', 'HireRequestController@approve')->name('approve');
//    Route::post('store', 'HireRequestController@store')->name('store');
//   // Route::resource('requisitions', 'HireRequestController'); implement individual routes instead
//    Route::get('listings', 'HireRequestController@listing')->name('listing');
//
//
//    /**
//     * Datatables
//     */
//    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
//        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
//            Route::get('processing', 'HireRequestController@AccessProcessingDatatable')->name('processing');
//        });
//    });
//});
