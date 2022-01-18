<?php
Route::group(['namespace' => 'Retirement', 'middleware' => ['web', 'auth'], 'prefix' => 'retirement', 'as' => 'retirement.'], function () {
    Route::get('', 'RetirementController@index')->name('index');
//    Route::get('create', 'RetirementController@create')->name('create');
    Route::get('{retirement}/create', 'RetirementController@create')->name('create');
    Route::post('store', 'RetirementController@store')->name('store');
    Route::post('{uuid}/update', 'RetirementController@update')->name('update');
    Route::get('{retirement}/show', 'RetirementController@show')->name('show');
//    Route::get('{retirement}/edit', 'RetirementController@create')->name('edit');
    Route::get('initiate', 'RetirementController@initiate')->name('initiate');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'RetirementController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'RetirementController@AccessRejectedDatatable')->name('rejected');

//            Route::get('approved', 'RetirementController@AccessApprovedDatatable')->name('approved');
//            Route::get('saved', 'RetirementController@AccessDatatable')->name('saved');
//            Route::get('paid', 'RetirementController@AccesssDatatable')->name('paid');
        });
    });

});
