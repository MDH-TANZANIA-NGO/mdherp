<?php
Route::group(['namespace' => 'Userbio', 'middleware' => ['web', 'auth'], 'prefix' => 'userbio', 'as' => 'userbio.'], function () {

    //Users Bio
    Route::get('', 'UserbioController@index')->name('index');
    Route::get('create', 'UserbioController@create')->name('create');
    Route::get('{uuid}/show', 'UserbioController@show')->name('show');
    Route::post('{uuid}/update', 'UserbioController@update')->name('update');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('active', 'UserbioController@activeDatatable')->name('active');
    });

});
