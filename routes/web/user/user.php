<?php
Route::group(['namespace' => 'User', 'middleware' => ['web', 'auth'], 'prefix' => 'users', 'as' => 'user.'], function () {
    Route::get('', 'UserController@index')->name('index');
    Route::get('create', 'UserController@create')->name('create');
    Route::post('store', 'UserController@store')->name('store');
    Route::get('{user}/profile', 'UserController@profile')->name('profile');
    Route::put('{user}/update', 'UserController@update')->name('update');

    Route::post('{user}/update-workflow-definitions', 'UserController@updateWfDefinition')->name("update_definitions");

    Route::post('{uuid}/attach-sub-program', 'UserController@assignSubProgramArea')->name("attach_sub_program");

    Route::post('{user_id}/assign-supervisor', 'UserController@assignSupervisor')->name("assign_supervisor");
    Route::get('{users}/remove-supervisor', 'UserController@deleteSupervisor')->name("remove_supervisor");


    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('active', 'UserController@activeDatatable')->name('active');
    });
});
