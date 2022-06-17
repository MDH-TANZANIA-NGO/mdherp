<?php
Route::group(['namespace' => 'Budget', 'middleware' => ['web', 'auth'], 'prefix' => 'budgets', 'as' => 'budget.'], function () {
    Route::get('', 'BudgetController@index')->name('index');
    Route::get('create', 'BudgetController@create')->name('create');
    Route::post('store', 'BudgetController@store')->name('store');
    Route::get('{budget}/show', 'BudgetController@show')->name('show');
    Route::put('{budget}/update', 'BudgetController@update')->name('update');
    Route::put('{budget}/activate', 'BudgetController@activate')->name('activate');
    Route::get('/region/{activity_id}', 'BudgetController@byRegion')->name('by_region');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all-active', 'BudgetController@allActiveDatatable')->name('all_active');
    });
});
