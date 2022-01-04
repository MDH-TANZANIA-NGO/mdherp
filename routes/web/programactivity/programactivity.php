<?php
Route::group(['namespace' => 'ProgramActivity', 'middleware' => ['web', 'auth'], 'prefix' => 'programactivity', 'as' => 'programactivity.'], function () {
    Route::get('', 'ProgramActivityController@index')->name('index');
    Route::get('initiate', 'ProgramActivityController@initiate')->name('initiate');
    Route::post('store', 'ProgramActivityController@store')->name('store');
    Route::get('{programActivity}/create', 'ProgramActivityController@create')->name('create');

    Route::post('{uuid}/update', 'ProgramActivityController@update')->name('update');

    Route::get('{programActivity}/show', 'ProgramActivityController@show')->name('show');



    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'ProgramActivityController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'ProgramActivityController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'ProgramActivityController@AccessApprovedDatatable')->name('approved');
            Route::get('saved', 'ProgramActivityController@AccessDatatable')->name('saved');
            Route::get('paid', 'ProgramActivityController@AccesssDatatable')->name('paid');
        });
    });

});
