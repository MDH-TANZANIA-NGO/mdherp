<?php
Route::group(['namespace' => 'Requisition', 'middleware' => ['web', 'auth'], 'prefix' => 'requisitions', 'as' => 'requisition.'], function () {
    Route::get('/', 'RequisitionController@index')->name('index');
    Route::get('/create', 'RequisitionController@create')->name('create');
    Route::post('/store', 'RequisitionController@store')->name('store');
    Route::get('/{requisition}/show', 'RequisitionController@show')->name('show');
    Route::get('/districts/{regionID}', 'RequisitionController@getDistricts')->name('region.districts');
    Route::get('/activities/{projectID}', 'RequisitionController@getProjectActivities')->name('project.activities');
    Route::put('/{requisition}/update', 'RequisitionController@update')->name('update');
});

