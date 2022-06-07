<?php


Route::group(['namespace' => 'Fleet', 'middleware' => ['web', 'auth'], 'prefix' => 'fleet', 'as' => 'fleet.'], function () {
   
    Route::get('index2', 'FleetController@index2')->name('index2');
    Route::post('register.store','FleetController@storeRegister')->name('register.store');
    Route::get('register.create', 'FleetController@createRegister')->name('register.create');
    Route::get('register.edit/{id}', 'FleetController@editRegister')->name('register.edit');
    Route::post('register.edit/{id}', 'FleetController@updateRegister')->name('register.update');
    Route::get('register.destroy/{id}', 'FleetController@destroyRegister')->name('register.destroy');
    Route::get('register.view/{id}', 'FleetController@viewRegister')->name('register.view');
   



    Route::get('', 'RequestController@index')->name('index');
    Route::post('store', 'RequestController@store')->name('store');
    Route::get('{fleetrequest}/show', 'RequestController@show')->name('show');
    Route::get('create', 'RequestController@create')->name('create');
    Route::get('{uuid}/edit', 'RequestController@edit')->name('edit');
    Route::post('edit/{id}', 'RequestController@update')->name('update');
    Route::get('destroy/{id}', 'RequestController@destroy')->name('destroy');

    Route::get('flee', 'RequestController@flee')->name('flee');
    
        /**
         * Datatables
         */
        Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'RequestController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'RequestController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'RequestController@AccessApprovedDatatable')->name('approved');
            Route::get('saved', 'RequestController@AccessSavedDatatable')->name('saved');

        });
        });
    });



