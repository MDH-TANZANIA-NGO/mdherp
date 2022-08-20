<?php

Route::group(['namespace' => 'Hotel', 'middleware' => ['web', 'auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('', 'HotelController@workspace')->name('workspace');
    Route::get('index', 'HotelController@index')->name('index');
    Route::get('create', 'HotelController@create')->name('create');
    Route::get('hotelRequests', 'HotelController@hotelRequests')->name('hotelRequests');
    Route::post('store', 'HotelController@store')->name('store');
    Route::post('register_owner', 'HotelController@storeVendor')->name('register_owner');

    /**
     * Datatables
     */
  Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'HotelController@getAllSafariBookingRequests')->name('all');
    });
});
