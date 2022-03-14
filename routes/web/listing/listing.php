<?php
Route::group(['namespace' => 'Listing', 'middleware' => ['web', 'auth'], 'prefix' => 'listings', 'as' => 'listing.'], function () {
    Route::get('', 'ListingController@index')->name('index');
    Route::get('create', 'ListingController@create')->name('create');
    Route::post('store', 'ListingController@store')->name('store');
    Route::get('{listing}/show', 'ListingController@show')->name('show');
    Route::put('{listing}/update', 'ListingController@update')->name('update');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'ListingController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'ListingController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'ListingController@AccessProvedDatatable')->name('approved');
        });
    });
});

Route::group(['namespace' => 'Listing', 'middleware' => 'web'], function(){
    Route::get('vacancies', 'ListingController@getVacancies')->name('vacancies');
    Route::get('{listing}/vacancy', 'ListingController@getVacancy')->name('vacancy');
});
