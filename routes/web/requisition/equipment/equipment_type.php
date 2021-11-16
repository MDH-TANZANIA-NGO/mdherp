<?php
Route::group(['namespace' => 'Requisition\Equipment', 'middleware' => ['web', 'auth'], 'prefix' => 'equipment-types', 'as' => 'equipment_type.'], function () {
    Route::get('', 'EquipmentTypeController@index')->name('index');
    Route::post('store', 'EquipmentTypeController@store')->name('store');
    Route::get('{activity}/show', 'EquipmentTypeController@show')->name('show');
    Route::get('{activity}/show/{uuid}/fiscal-year', 'EquipmentTypeController@show')->name('show_fiscal_year');
    Route::put('{activity}/update', 'EquipmentTypeController@update')->name('update');
    Route::put('{activity}/activate', 'EquipmentTypeController@activate')->name('activate');
    Route::put('{activity}/activate', 'EquipmentTypeController@activate')->name('activate');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'EquipmentTypeController@allDatatable')->name('all');
    });
});
