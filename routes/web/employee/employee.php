<?php
Route::group(['namespace' => 'Employee', 'middleware' => ['web', 'auth'], 'prefix' => 'employees', 'as' => 'employee.'], function () {
    Route::get('', 'EmployeeController@index')->name('index');

    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('active', 'EmployeeController@activeDatatable')->name('active');
        Route::get('inactive', 'EmployeeController@InactiveDatatable')->name('inactive');
    });
});
