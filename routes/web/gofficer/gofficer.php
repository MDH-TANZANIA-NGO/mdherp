<?php
Route::group(['namespace' => 'GOfficer', 'middleware' => ['web', 'auth'], 'prefix' => 'government-officers', 'as' => 'g_officer.'], function () {
    Route::get('', 'GOfficerController@index')->name('index');
    Route::get('create', 'GOfficerController@create')->name('create');
    Route::get('bulk_update', 'GOfficerController@bulkUpdate')->name('bulk_update');
    Route::get('confirm', 'GOfficerController@confirmAndUpload')->name('confirm');
    Route::get('pushBulkUpdate', 'GOfficerController@pushBulkUpdate')->name('pushBulkUpdate');
    Route::get('clear', 'GOfficerController@clearImportHistory')->name('clear');
    Route::get('export_duplicate', 'GOfficerController@exportDuplicateImportedData')->name('export_duplicate');
    Route::post('store', 'GOfficerController@store')->name('store');
    Route::get('{uuid}/show', 'GOfficerController@show')->name('show');
    Route::get('getDistricts/{id}', 'GOfficerController@getDistricts')->name('getDistricts');
    Route::get('getFacilities/{id}', 'GOfficerController@getFacilities')->name('getFacilities');
    Route::put('{uuid}/update', 'GOfficerController@update')->name('update');
    Route::put('{uuid}/activate', 'GOfficerController@activate')->name('activate');
    Route::post('import', 'GOfficerController@import')->name('import');
    Route::post('bulk_update_import', 'GOfficerController@bulkUpdateImport')->name('bulk_update_import');
    Route::post('filter', 'GOfficerController@filterGofficer')->name('filter');
    Route::post('filterBulkGOfficer', 'GOfficerController@filterBulkGOfficer')->name('filterBulkGOfficer');


    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'GOfficerController@allDatatable')->name('all');
        Route::get('bulk_imported', 'GOfficerController@bulkImported')->name('bulk_imported');
    });
});
