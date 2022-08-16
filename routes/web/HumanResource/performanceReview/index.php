<?php
Route::group(['namespace' => 'HumanResource', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource', 'as' => 'hr.'], function () {

    //Performance Review
    Route::group(['namespace' => 'PerformanceReview', 'prefix' => 'performance-reviews', 'as' => 'pr.'], function () {
        Route::get('', 'PrReportController@index')->name('index');
        Route::get('create', 'PrReportController@create')->name('create');
        Route::post('store', 'PrReportController@store')->name('store');
        Route::get('{pr_report}/saved', 'PrReportController@saved')->name('saved');
        Route::get('{pr_report}/show', 'PrReportController@show')->name('show');
        Route::get('{pr_report}/show-completed', 'PrReportController@showCompleted')->name('show_completed');
        Route::put('{pr_report}/update', 'PrReportController@update')->name('update');
        Route::post('{pr_report}/submit', 'PrReportController@submit')->name('submit');
        Route::get('{pr_report}/completed', 'PrReportController@completed')->name('completed');
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
            Route::post('{pr_competence_key_narration}/{pr_report}/store-or-update', 'PrCompetenceController@storeOrUpdate')->name('store_update');
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
        //Remarks
        Route::group(['prefix' => 'remarks', 'as' => 'remark.'], function () {
            Route::post('{pr_report}/store', 'PrRemarkController@store')->name('store');
        });
        //Skills
        Route::group(['prefix' => 'skills', 'as' => 'skill.'], function () {
            Route::post('{pr_report}/store', 'PrSkillController@store')->name('store');
        });
        //education
        Route::group(['prefix' => 'educations', 'as' => 'education.'], function () {
            Route::post('{pr_report}/store', 'PrEducationOpportunityController@store')->name('store');
        });

        //next objective
        Route::group(['prefix' => 'next-year-objectives', 'as' => 'next_objective.'], function () {
            Route::post('{pr_report}/store', 'PrNextObjectiveController@store')->name('store');
            Route::put('{pr_next_objective}/update', 'PrNextObjectiveController@update')->name('update');
            Route::get('{pr_next_objective}/destroy', 'PrNextObjectiveController@destroy')->name('destroy');
        });

        //PrAchievementCommentController
        Route::group(['prefix' => 'achievement-comments', 'as' => 'achievement_comment.'], function () {
            Route::post('{pr_report}/store', 'PrAchievementCommentController@store')->name('store');
            Route::put('{pr_achievement_comment}/update', 'PrAchievementCommentController@update')->name('update');
        });

        //PrRecommendationController
        Route::group(['prefix' => 'recommandations-to-human-resource', 'as' => 'recommendation.'], function () {
            Route::post('{pr_report}/store', 'PrRecommendationController@store')->name('store');
            Route::put('{pr_recommendation}/update', 'PrRecommendationController@update')->name('update');
        });

    });

});

