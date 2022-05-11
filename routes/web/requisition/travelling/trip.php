<?php

Route::group(['namespace' => 'Requisition\Travelling', 'middleware' => ['web', 'auth'], 'prefix' => 'trip', 'as' => 'trip.'], function () {
    Route::get('{uuid}/create', 'RequisitionTravellingCostDistrictController@create')->name('create');
    Route::get('{uuid}/delete', 'RequisitionTravellingCostDistrictController@delete')->name('delete');
    Route::get('{uuid}/edit', 'RequisitionTravellingCostDistrictController@edit')->name('edit');
    Route::get('{uuid}/submitAllTrips', 'RequisitionTravellingCostDistrictController@submitAllTrips')->name('submitAllTrips');
    Route::post('{uuid}/update', 'RequisitionTravellingCostDistrictController@update')->name('update');
    Route::post('store', 'RequisitionTravellingCostDistrictController@store')->name('store');


});
