<?php
Route::group(['namespace' => 'SupplyChain', 'middleware' => ['web', 'auth'], 'prefix' => 'stock-unit', 'as' => 'unit.'], function () {
    Route::get('', 'StockUnitController@stockUnit')->name('unit');
    Route::post('store', 'StockUnitController@storeUnit')->name('store');

    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'StockUnitController@alldatatable')->name('all');
    });
});

