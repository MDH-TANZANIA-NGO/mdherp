<?php

Route::group(['namespace' => 'ProgramActivity', 'middleware' => ['web', 'auth'], 'prefix' => 'programactivityreport', 'as' => 'programactivityreport.'], function () {
    Route::get('', 'ProgramActivityReportController@index')->name('index');
    Route::get('initiate', 'ProgramActivityReportController@initiate')->name('initiate');
    Route::get('{programActivityReport}/create', 'ProgramActivityReportController@create')->name('create');
    Route::get('{programActivityReport}/edit', 'ProgramActivityReportController@edit')->name('edit');
    Route::post('store', 'ProgramActivityReportController@store')->name('store');
    Route::post('{uuid}/update', 'ProgramActivityReportController@update')->name('update');
    Route::get('{uuid}/show', 'ProgramActivityReportController@show')->name('show');




    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'ProgramActivityReportController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'ProgramActivityReportController@AccessReturnedDatatable')->name('rejected');
            Route::get('approved', 'ProgramActivityReportController@AccessApprovedDatatable')->name('approved');
            Route::get('saved', 'ProgramActivityReportController@AccessSavedDatatable')->name('saved');
        });

    });


});
