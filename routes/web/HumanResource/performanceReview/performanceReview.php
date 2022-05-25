<?php
Route::group(['namespace' => 'HumanResource/PerformanceReview', 'middleware' => ['web', 'auth'], 'prefix' => 'performance-review', 'as' => 'pr.'], function () {

    Route::group(['prefix' => 'reports', 'as' => 'report.'], function () {
        Route::get('processing', 'PrReportController@index')->name('index');
    });

//    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
//        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
//            Route::get('processing', 'LeaveController@AccessProcessingDatatable')->name('processing');
//            Route::get('rejected', 'LeaveController@AccessRejectedDatatable')->name('rejected');
//            Route::get('approved', 'LeaveController@AccessApprovedDatatable')->name('approved');
//            Route::get('saved', 'LeaveController@AccessSavedDatatable')->name('saved');
//        });
//    });
});

