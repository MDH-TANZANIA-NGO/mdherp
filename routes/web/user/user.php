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
    Route::post('{user}/update-permission', 'UserController@updatePermissions')->name("permission_update");
    Route::post('/import', 'UserController@import')->name("import");
    Route::post('assign-supervisor-individual', 'UserController@assignSupervisorIndividual')->name("assign_supervisor_individual");
    Route::get('{user}/password-reset', 'UserController@resetPassword')->name("password_reset");

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('active', 'UserController@activeDatatable')->name('active');
        Route::get('inactive', 'UserController@InactiveDatatable')->name('inactive');
    });
});
