<?php

Route::group(['namespace' =>'HumanResource\Advertisement', 'middleware' => ['web', 'auth'], 'prefix' => 'advertisement', 'as' => 'advertisement.'], function () {

  Route::get('', 'AdvertisementController@index')->name('index');
  Route::get('create','AdvertisementController@create')->name('create');
  Route::get('initiate/{initiate}','AdvertisementController@initiate')->name('initiate');

   Route::get('pending', 'AdvertisementController@pending')->name('pending');
   Route::post('approve', 'AdvertisementController@approve')->name('approve');
   Route::post('store', 'AdvertisementController@store')->name('store');
   Route::get('show/{advertisement}', 'AdvertisementController@show')->name('show');
  // Route::resource('requisitions', 'HireRequestController'); implement individual routes instead
   Route::get('listings', 'AdvertisementController@listing')->name('listing');

   /**
    * Datatables
    */
//    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
//        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
//            Route::get('processing', 'AdvertisementController@AccessProcessingDatatable')->name('processing');
//        });
//    });
   Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
    Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
        Route::get('processing', 'AdvertisementController@AccessProcessingDatatable')->name('processing');
        Route::get('returned', 'AdvertisementController@AccessDeniedDatatable')->name('returned');
        Route::get('rejected', 'AdvertisementController@AccessRejectedDatatable')->name('rejected');
        Route::get('approved', 'AdvertisementController@AccessProvedDatatable')->name('approved');
        Route::get('saved', 'AdvertisementController@AccessSavedDatatable')->name('saved');
    });
});
});
