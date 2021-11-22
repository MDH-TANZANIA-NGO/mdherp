<?php
Route::group(['namespace' => 'User', 'middleware' => ['web', 'auth'], 'prefix' => 'users', 'as' => 'user.'], function () {
    Route::get('', 'UserController@index')->name('index');
    Route::get('create', 'UserController@create')->name('create');
    Route::post('store', 'UserController@store')->name('store');
    Route::get('{user}/profile', 'UserController@profile')->name('profile');

    Route::post('{user}/update-workflow-definitions', 'UserController@updateWfDefinition')->name("update_definitions");


    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('active', 'UserController@activeDatatable')->name('active');
    });
});
