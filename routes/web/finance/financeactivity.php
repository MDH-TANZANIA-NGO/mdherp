<?php
Route::group(['namespace' => 'Finance', 'middleware' => ['web', 'auth'], 'prefix' => 'finance', 'as' => 'finance.'], function () {
    Route::get('', 'FinanceActivityController@index')->name('index');
    Route::get('{uuid}/show', 'FinanceActivityController@show')->name('show');
    Route::post('store', 'FinanceActivityController@store')->name('store');
    Route::post('store_safari_payment', 'FinanceActivityController@storeSafariPayment')->name('store_safari_payment');
    Route::post('store_activity_payment', 'FinanceActivityController@storeActivityPayment')->name('store_activity_payment');
    Route::post('{uuid}/update_activity_payment', 'FinanceActivityController@updateActivityPayment')->name('update_activity_payment');
    Route::post('{uuid}/update', 'FinanceActivityController@update')->name('update');
    Route::get('{payment}/view', 'FinanceActivityController@view')->name('view');
    Route::get('{payment}/SubmitPayment', 'FinanceActivityController@SubmitPayment')->name('SubmitPayment');
    Route::get('{uuid}/export', 'FinanceActivityController@export')->name('export');
    Route::get('{uuid}/safari_payment', 'FinanceActivityController@safariPayment')->name('safari_payment');
    Route::get('{uuid}/edit_safari_payment', 'FinanceActivityController@safariPaymentEditForApproval')->name('edit_safari_payment');
    Route::get('{uuid}/safari_payment_for_approval', 'FinanceActivityController@safariPaymentSubmitForApproval')->name('safari_payment_for_approval');
    Route::get('{uuid}/activity_payment_for_approval', 'FinanceActivityController@ActivityPaymentSubmitForApproval')->name('activity_payment_for_approval');
    Route::post('{uuid}/update_safari_payment', 'FinanceActivityController@updateSafariPayment')->name('update_safari_payment');
    Route::post('{uuid}/updatePayment', 'FinanceActivityController@updatePayment')->name('updatePayment');
    Route::post('{uuid}/sendSafariPaymentForApproval', 'FinanceActivityController@sendSafariPaymentForApproval')->name('sendSafariPaymentForApproval');
    Route::get('{uuid}/sendActivityPaymentForApproval', 'FinanceActivityController@sendActivityPaymentForApproval')->name('sendActivityPaymentForApproval');
    Route::get('{uuid}/showSafariPayment', 'FinanceActivityController@showSafariPayment')->name('showSafariPayment');

    Route::get('{uuid}/program_activity_payment', 'FinanceActivityController@programActivityPayment')->name('program_activity_payment');


    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('requisitions', 'FinanceActivityController@allApprovedRequisitions')->name('requisition');
            Route::get('safari_advances', 'FinanceActivityController@allApprovedSafariAdvances')->name('safari_advance');
            Route::get('program_activities', 'FinanceActivityController@allApprovedProgramActivities')->name('program_activity');
            Route::get('program_activity_reports', 'FinanceActivityController@allApprovedProgramActivitiesReports')->name('program_activity_reports');
            Route::get('retirements', 'FinanceActivityController@allApprovedRetirements')->name('retirement');
//            Route::get('paid', 'FinanceActivityController@AccesssDatatable')->name('paid');
        });
    });
});

