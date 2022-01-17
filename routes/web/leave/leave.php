<?php
Route::group(['namespace' => 'Leave', 'middleware' => ['web', 'auth'], 'prefix' => 'leave', 'as' => 'leave.'], function () {
    Route::get('', 'LeaveController@index')->name('index');
    Route::get('/create', 'LeaveController@create')->name('create');
    Route::get('{uuid}/edit', 'LeaveController@create')->name('edit');
    Route::post('store', 'LeaveController@store')->name('store');
    Route::post('{uuid}/update', 'LeaveController@update')->name('update');
    Route::get('{uuid}/show', 'LeaveController@show')->name('show');



    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'LeaveController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'LeaveController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'LeaveController@AccessApprovedDatatable')->name('approved');
            Route::get('saved', 'LeaveController@AccessDatatable')->name('saved');
        });
    });
});

