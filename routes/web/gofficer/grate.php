<?php
Route::group(['namespace' => 'GOfficer', 'middleware' => ['web', 'auth'], 'prefix' => 'government-rates', 'as' => 'g_rate.'], function () {
    Route::get('', 'GRateController@index')->name('index');
    Route::post('store', 'GRateController@store')->name('store');
    Route::post('store-gov-rate', 'GRateController@storeGovRate')->name('store-gov-rate');
    Route::get('{uuid}/show', 'GRateController@show')->name('show');
    Route::put('{uuid}/update', 'GRateController@update')->name('update');
    Route::put('{uuid}/update-gov-rate', 'GRateController@updateGovRate')->name('updateGovRate');
    Route::put('{uuid}/activate', 'GRateController@activate')->name('activate');
    Route::post('assign-rate', 'GRateController@assignRate')->name('assign');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'GRateController@allDatatable')->name('all');
        Route::get('all-gov-rates', 'GRateController@allGovRatesDatatable')->name('all-gov-rates');
    });
});
