<?php

Route::group(['namespace' => 'ProgramActivity', 'middleware' => ['web', 'auth'], 'prefix' => 'programactivityreport', 'as' => 'programactivityreport.'], function () {
    Route::get('', 'ProgramActivityReportController@index')->name('index');
    Route::get('initiate', 'ProgramActivityReportController@initiate')->name('initiate');
    Route::post('store', 'ProgramActivityReportController@store')->name('store');
    Route::get('{programActivity}/create', 'ProgramActivityReportController@create')->name('create');


    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'ProgramActivityReportController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'ProgramActivityReportController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'ProgramActivityReportController@AccessApprovedDatatable')->name('approved');
            Route::get('saved', 'ProgramActivityReportController@AccessDatatable')->name('saved');
        });

    });


});
