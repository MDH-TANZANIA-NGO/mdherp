<?php
Route::group(['namespace' => 'HumanResource', 'middleware' => ['web', 'auth'], 'prefix' => 'human-resource', 'as' => 'hr.'], function () {

    //Performance Review
    Route::group(['namespace' => 'PerformanceReview', 'prefix' => 'performance-reviews', 'as' => 'pr.'], function () {
        Route::get('', 'PrReportController@index')->name('index');
        Route::get('create', 'PrReportController@create')->name('create');
        Route::post('store', 'PrReportController@store')->name('store');
        Route::get('{prReport}/saved', 'PrReportController@saved')->name('saved');
        Route::get('{prReport}/show', 'PrReportController@show')->name('show');
        Route::put('{prReport}/update', 'PrReportController@update')->name('update');
        Route::post('{prReport}/submit', 'PrReportController@store')->name('store');
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
            Route::get('{prReport}/create', 'PrAttributeRateController@create')->name('create');
            Route::post('{prReport}/store', 'PrAttributeRateController@store')->name('store');
            Route::put('{prReport}/{prAttributeRate}/update', 'PrAttributeRateController@update')->name('update');
        });
        //Compentence
        Route::group(['prefix' => 'competences', 'as' => 'competence.'], function () {
            Route::get('{prReport}/create', 'PrCompetenceController@create')->name('create');
            Route::post('{prReport}/store', 'PrCompetenceController@store')->name('store');
            Route::put('{prReport}/{prCompetence}/update', 'PrCompetenceController@update')->name('update');
        });
        //Objective
        Route::group(['prefix' => 'objectives', 'as' => 'competence.'], function () {
            Route::get('{prReport}/create', 'PrObjectiveController@create')->name('create');
            Route::post('{prReport}/store', 'PrObjectiveController@store')->name('store');
            Route::put('{prReport}/{prObjective}/update', 'PrObjectiveController@update')->name('update');
        });
    });

});

