<?php
Route::group(['namespace' => 'Project', 'middleware' => ['web', 'auth'], 'prefix' => 'activities', 'as' => 'activity.'], function () {
    Route::get('', 'EquipmentController@index')->name('index');
    Route::post('store', 'EquipmentController@store')->name('store');
    Route::get('{activity}/show', 'EquipmentController@show')->name('show');
    Route::get('{activity}/show/{uuid}/fiscal-year', 'EquipmentController@show')->name('show_fiscal_year');
    Route::put('{activity}/update', 'EquipmentController@update')->name('update');
    Route::put('{activity}/activate', 'EquipmentController@activate')->name('activate');
    Route::put('{activity}/activate', 'EquipmentController@activate')->name('activate');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'EquipmentController@allDatatable')->name('all');
    });
});
