<?php
Route::group(['namespace' => 'Budget', 'middleware' => ['web', 'auth'], 'prefix' => 'budgets', 'as' => 'budget.'], function () {
    Route::get('', 'BudgetController@index')->name('index');
    Route::post('store', 'BudgetController@store')->name('store');
    Route::get('{project}/show', 'BudgetController@show')->name('show');
    Route::put('{project}/update', 'BudgetController@update')->name('update');
    Route::put('{project}/activate', 'BudgetController@activate')->name('activate');
    Route::get('/region', 'BudgetController@byRegion')->name('by_region');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'BudgetController@allDatatable')->name('all');
    });
});
