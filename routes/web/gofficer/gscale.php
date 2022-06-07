<?php
Route::group(['namespace' => 'GOfficer', 'middleware' => ['web', 'auth'], 'prefix' => 'government-scales', 'as' => 'g_scale.'], function () {
    Route::get('', 'GScaleController@index')->name('index');
    Route::post('store', 'GScaleController@store')->name('store');
    Route::post('store-government-scale', 'GScaleController@storeGovernmentScale')->name('storeGovernmentScale');
    Route::get('{uuid}/show', 'GScaleController@show')->name('show');
    Route::put('{uuid}/update', 'GScaleController@update')->name('update');
    Route::put('{uuid}/update-government-scale', 'GScaleController@updateGovernmentScale')->name('updateGovernmentScale');
    Route::put('{uuid}/activate', 'GScaleController@activate')->name('activate');

    Route::get('for-g-rate', 'GScaleController@getForDualList')->name('g_rate');
    Route::get('for-government-rate', 'GScaleController@getNewForDualiList')->name('government_rate');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'GScaleController@allDatatable')->name('all');
    });
});
