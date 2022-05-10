<?php

Route::group(['namespace' => 'Requisition\Travelling', 'middleware' => ['web', 'auth'], 'prefix' => 'trip', 'as' => 'trip.'], function () {
    Route::get('{uuid}/create', 'RequisitionTravellingCostDistrictController@create')->name('create');
    Route::get('{uuid}/delete', 'RequisitionTravellingCostDistrictController@delete')->name('delete');
    Route::post('store', 'RequisitionTravellingCostDistrictController@store')->name('store');


});
