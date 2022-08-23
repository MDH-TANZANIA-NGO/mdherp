<?php

Route::group(['namespace' => 'Hotel', 'middleware' => ['web', 'auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('', 'HotelController@workspace')->name('workspace');
    Route::get('index', 'HotelController@index')->name('index');
    Route::get('create', 'HotelController@create')->name('create');
    Route::get('vendor', 'HotelController@vendors')->name('vendor');
    Route::get('hotelRequests', 'HotelController@hotelRequests')->name('hotelRequests');
    Route::post('store', 'HotelController@store')->name('store');
    Route::post('storeServices', 'HotelController@storeServices')->name('storeServices');
    Route::get('{uuid}/edit', 'HotelController@edit')->name('edit');
    Route::get('{uuid}/editVendor', 'HotelController@editVendor')->name('editVendor');
    Route::get('{uuid}/editService', 'HotelController@editService')->name('editService');
    Route::get('{uuid}/delete', 'HotelController@destroy')->name('delete');
    Route::post('{uuid}/update', 'HotelController@update')->name('update');
    Route::post('{id}/updateService', 'HotelController@updateService')->name('updateService');
    Route::post('register_owner', 'HotelController@storeVendor')->name('register_owner');

    /**
     * Datatables
     */
  Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'HotelController@getAllSafariBookingRequests')->name('all');
    });
});
