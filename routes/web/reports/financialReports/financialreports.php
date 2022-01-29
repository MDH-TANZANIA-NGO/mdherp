<?php
Route::group(['namespace' => 'FinanceReports', 'middleware' => ['web', 'auth'], 'prefix' => 'financial-report', 'as' => 'financial-report.'], function () {
    Route::get('', 'FinanceReportsController@index')->name('index');
    Route::get('paymentBatches', 'FinanceReportsController@paymentBatches')->name('paymentBatches');


    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'FinanceReportsController@AccessProcessingDatatable')->name('processing');
//            Route::get('rejected', 'FinanceReportsController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'FinanceReportsController@AccessApprovedDatatable')->name('approved');
        });
    });

});
