<?php
Route::group(['namespace' => 'Person', 'middleware' => ['web', 'auth'], 'prefix' => 'person', 'as' => 'person.'], function () {
    Route::get('', 'PersonController@index')->name('index');



    //health details
    Route::get('/health-details/create', 'PersonController@createHealth')->name('health.create');
    Route::post('/health-details', 'PersonController@health')->name('health');
    Route::put('{employee}/health-details', 'PersonController@updateHealth')->name('health.update');

    //Address
    Route::get('/address/create', 'AddressController@create')->name('address.create');
    Route::post('/address', 'AddressController@store')->name('address.store');
    Route::get('{address}/address', 'AddressController@show')->name('address.show');
    Route::put('{address}/address', 'AddressController@update')->name('address.update');

    /**
    //     * Datatables
    //     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'address', 'as' => 'address.'], function () {
            Route::get('processing', 'AddressController@allDatatables')->name('all');
        });
    });

    //Family
    Route::get('/family/create', 'FamilyController@create')->name('family.create');
    Route::post('/family', 'FamilyController@store')->name('family.store');
    Route::get('{family}/family', 'FamilyController@show')->name('family.show');
    Route::put('{family}/family', 'FamilyController@update')->name('family.update');

    /**
    //     * Datatables
    //     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'family', 'as' => 'family.'], function () {
            Route::get('processing', 'FamilyController@allDatatables')->name('all');
        });
    });

    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('active', 'UserController@activeDatatable')->name('active');
    });

});
