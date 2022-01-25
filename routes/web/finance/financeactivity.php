<?php
Route::group(['namespace' => 'Finance', 'middleware' => ['web', 'auth'], 'prefix' => 'finance', 'as' => 'finance.'], function () {
    Route::get('', 'FinanceActivityController@index')->name('index');
    Route::get('{uuid}/show', 'FinanceActivityController@show')->name('show');
    Route::post('store', 'FinanceActivityController@store')->name('store');
    Route::post('{uuid}/update', 'FinanceActivityController@update')->name('update');
    Route::get('{payment}/view', 'FinanceActivityController@view')->name('view');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('requisitions', 'FinanceActivityController@allApprovedRequisitions')->name('requisition');
            Route::get('safari_advances', 'FinanceActivityController@allApprovedSafariAdvances')->name('safari_advance');
            Route::get('program_activities', 'FinanceActivityController@allApprovedProgramActivities')->name('program_activity');
            Route::get('retirements', 'FinanceActivityController@allApprovedRetirements')->name('retirement');
//            Route::get('paid', 'FinanceActivityController@AccesssDatatable')->name('paid');
        });
    });
});


