<?php
Route::group(['namespace' => 'Finance', 'middleware' => ['web', 'auth'], 'prefix' => 'finance', 'as' => 'finance.'], function () {
    Route::get('', 'FinanceActivityController@index')->name('index');


    /**
     * Datatables
     */
//    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
//        Route::get('all-finance', 'FinanceActivityControllerr@allFinanceDatatable')->name('all_finance');
//    });

});
