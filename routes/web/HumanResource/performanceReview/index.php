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
        Route::post('{pr_report}/submit', 'PrReportController@submit')->name('submit');
        //Evaluation
        Route::group(['prefix' => 'evaluation', 'as' => 'evaluation.'], function () {
            Route::post('{pr_report}/initiate', 'PrReportController@evaluationInitiate')->name('initiate');
        });
        //Datatables
        Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
            Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
                Route::get('processing', 'PrReportController@accessProcessingDatatable')->name('processing');
                Route::get('returned-for-modications', 'PrReportController@accessReturnedForModificationDatatable')->name('return_for_modification');
                Route::get('approved', 'PrReportController@accessApprovedDatatable')->name('approved');
                Route::get('saved', 'PrReportController@accessSavedDatatable')->name('saved');
                Route::get('wait-for-evaluation', 'PrReportController@accessApprovedWaitForEvaluationDatatable')->name('wait_for_evaluation');
            });
        });
        //Attribute Rate
        Route::group(['prefix' => 'attribute-rate', 'as' => 'attribute_rate.'], function () {
            Route::post('{pr_attribute}/{pr_report}/store-or-update', 'PrAttributeRateController@storeOrUpdate')->name('store_update');
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
            Route::put('{pr_objective}/update', 'PrObjectiveController@update')->name('update');
            Route::put('update/{pr_objective}/challenge', 'PrObjectiveController@updateChallenge')->name('update_challenge');
            Route::post('update/{pr_objective}/scale-rate', 'PrObjectiveController@updateRateScale')->name('update_scale_rate');
            Route::get('{pr_objective}/destroy', 'PrObjectiveController@destroy')->name('destroy');
        });
    });

});

