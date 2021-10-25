<?php
Route::group(['namespace' => 'Project', 'middleware' => ['web', 'auth'], 'prefix' => 'sub-programs', 'as' => 'sub_program.'], function () {
    Route::get('', 'SubProgramController@index')->name('index');
    Route::post('store', 'SubProgramController@store')->name('store');
    Route::get('{subProgram}/show', 'SubProgramController@show')->name('show');
    Route::put('{subProgram}/update', 'SubProgramController@update')->name('update');
    Route::put('{subProgram}/activate', 'SubProgramController@activate')->name('activate');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'SubProgramController@allDatatable')->name('all');
    });
});
