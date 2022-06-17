<?php

Route::group(['namespace' =>'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'advertisement', 'as' => 'advertisement.'], function () {

  Route::get('', 'AdvertisementController@index')->name('index');
  Route::get('create','AdvertisementController@create')->name('create');
  Route::get('initiate/{initiate}','AdvertisementController@initiate')->name('initiate');

   Route::get('pending', 'AdvertisementController@pending')->name('pending');
   Route::post('approve', 'AdvertisementController@approve')->name('approve');
   Route::post('store', 'AdvertisementController@store')->name('store');
  // Route::resource('requisitions', 'HireRequestController'); implement individual routes instead
   Route::get('listings', 'AdvertisementController@listing')->name('listing');


   /**
    * Datatables
    */
   Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
       Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
           Route::get('processing', 'AdvertisementController@AccessProcessingDatatable')->name('processing');
       });
   });
});
