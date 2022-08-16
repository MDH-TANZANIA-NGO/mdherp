<?php
Route::group(['namespace' => 'Leave', 'middleware' => ['web', 'auth'], 'prefix' => 'leave', 'as' => 'leave.'], function () {
    Route::get('', 'LeaveController@index')->name('index');
    Route::get('/create', 'LeaveController@create')->name('create');
    Route::get('{leave}/edit', 'LeaveController@edit')->name('edit');
    Route::post('store', 'LeaveController@store')->name('store');
    Route::post('setup', 'LeaveController@setup')->name('setup');
    Route::put('{leave}/update', 'LeaveController@update')->name('update');
    Route::put('{user_id}/update_setup', 'LeaveController@updateSetup')->name('update_setup');
    Route::get('{leave}/show', 'LeaveController@show')->name('show');
    Route::get('{leave}/delete', 'LeaveController@deleteAccessLeave')->name('delete');



    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'LeaveController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'LeaveController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'LeaveController@AccessApprovedDatatable')->name('approved');
            Route::get('saved', 'LeaveController@AccessSavedDatatable')->name('saved');
        });
    });
});

