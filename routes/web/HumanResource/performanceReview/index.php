<?php
Route::group(['namespace' => 'HumanResource', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource', 'as' => 'hr.'], function () {

    //Performance Review
    Route::group(['namespace' => 'PerformanceReview', 'prefix' => 'performance-reviews', 'as' => 'pr.'], function () {
        Route::get('', 'PrReportController@index')->name('index');
        Route::get('create', 'PrReportController@create')->name('create');
        Route::post('probation-appraisal/store', 'PrReportController@probationStore')->name('probation_store');
        Route::get('{pr_report}/saved', 'PrReportController@saved')->name('saved');
        Route::get('{pr_report}/show', 'PrReportController@show')->name('show');
        Route::put('{pr_report}/update', 'PrReportController@update')->name('update');
        Route::post('{pr_report}/submit', 'PrReportController@store')->name('submit');
        //Datatables
        Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
            Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
                Route::get('processing', 'PrReportController@accessProcessingDatatable')->name('processing');
                Route::get('returned-for-modications', 'PrReportController@accessReturnedForModificationDatatable')->name('return_for_modification');
                Route::get('approved', 'PrReportController@accessApprovedDatatable')->name('approved');
                Route::get('saved', 'PrReportController@accessSavedDatatable')->name('saved');
            });
        });
        //Attribute Rate
        Route::group(['prefix' => 'attribute-rates', 'as' => 'attribute.'], function () {
            Route::get('{pr_report}/create', 'PrAttributeRateController@create')->name('create');
            Route::post('{pr_report}/store', 'PrAttributeRateController@store')->name('store');
            Route::put('{pr_report}/{prAttributeRate}/update', 'PrAttributeRateController@update')->name('update');
        });
        //Compentence
        Route::group(['prefix' => 'competences', 'as' => 'competence.'], function () {
            Route::get('{pr_report}/create', 'PrCompetenceController@create')->name('create');
            Route::post('{pr_report}/store', 'PrCompetenceController@store')->name('store');
            Route::put('{pr_report}/{prCompetence}/update', 'PrCompetenceController@update')->name('update');
        });
        //Objective
        Route::group(['prefix' => 'objectives', 'as' => 'objective.'], function () {
            // Route::get('{pr_report}/create', 'PrObjectiveController@create')->name('create');
            Route::post('{pr_report}/store', 'PrObjectiveController@store')->name('store');
            Route::put('{pr_report}/{prObjective}/update', 'PrObjectiveController@update')->name('update');
        });
    });

});

