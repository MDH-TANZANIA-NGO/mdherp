<?php
Route::group(['namespace' => 'GOfficer', 'middleware' => ['web', 'auth'], 'prefix' => 'government-officers', 'as' => 'g_officer.'], function () {
    Route::get('', 'GOfficerController@index')->name('index');
    Route::get('create', 'GOfficerController@create')->name('create');
    Route::get('confirm', 'GOfficerController@confirmAndUpload')->name('confirm');
    Route::get('clear', 'GOfficerController@clearImportHistory')->name('clear');
    Route::get('export_duplicate', 'GOfficerController@exportDuplicateImportedData')->name('export_duplicate');
    Route::post('store', 'GOfficerController@store')->name('store');
    Route::get('{uuid}/show', 'GOfficerController@show')->name('show');
    Route::get('getDistricts/{id}', 'GOfficerController@getDistricts')->name('getDistricts');
    Route::get('getFacilities/{id}', 'GOfficerController@getFacilities')->name('getFacilities');
    Route::put('{uuid}/update', 'GOfficerController@update')->name('update');
    Route::put('{uuid}/activate', 'GOfficerController@activate')->name('activate');
    Route::post('import', 'GOfficerController@import')->name('import');
    Route::post('filter', 'GOfficerController@filterGofficer')->name('filter');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'GOfficerController@allDatatable')->name('all');
    });
});
