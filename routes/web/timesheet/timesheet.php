<?php
Route::group(['namespace' => 'Timesheet', 'middleware' => ['web', 'auth'], 'prefix' => 'timesheet', 'as' => 'timesheet.'], function () {
    Route::get('', 'TimesheetController@index')->name('index');
    Route::get('create', 'TimesheetController@create')->name('create');
    Route::post('store', 'TimesheetController@store')->name('store');
    Route::get('{timesheet}/show', 'TimesheetController@show')->name('show');
    Route::get('{timesheet}/edit', 'TimesheetController@edit')->name('edit');
    Route::put('{timesheet}/update', 'TimesheetController@update')->name('update');
    Route::get('initiate', 'TimesheetController@create')->name('initiate');
    Route::post('setup', 'TimesheetController@setup')->name('setup');

//Datatable routes for an authenticated user
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('processing', 'TimesheetController@AccessProcessingDatatable')->name('processing');
        Route::get('rejected', 'TimesheetController@AccessRejectedDatatable')->name('rejected');
        Route::get('approved', 'TimesheetController@AccessApprovedDatatable')->name('approved');
    });
});


