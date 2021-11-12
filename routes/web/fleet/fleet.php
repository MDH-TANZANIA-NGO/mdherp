<?php
Route::group(['namespace' => 'fleet', 'middleware' => ['web', 'auth'], 'prefix' => 'fleet', 'as' => 'fleet.'], function () {
    Route::get('', 'FleetController@index')->name('index');
    Route ::get('register','FleetController@create')->name('register');

        /**
         * Datatables
         */
        Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
            Route::get('all-fleet', 'FleetController@allFleetDatatable')->name('all_fleet');
        });

});
