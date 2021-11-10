<?php
Route::group(['namespace' => 'fleet', 'middleware' => ['web', 'auth'], 'prefix' => 'fleet', 'as' => 'fleet.'], function () {
    Route::get('', 'FleetController@index')->name('index');
//    Route::get('create', 'UserController@create')->name('create');
//    Route::post('store', 'UserController@store')->name('store');
//    Route::get('{user}/profile', 'UserController@profile')->name('profile');


    /**
     * Datatables
     */
//    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
//        Route::get('active', 'UserController@activeDatatable')->name('active');
//    });
});
