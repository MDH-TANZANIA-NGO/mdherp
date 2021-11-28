<?php

Route::group(['namespace' => 'SupplyChain', 'middleware' => ['web', 'auth'], 'prefix' => 'stocks', 'as' => 'stock.'], function () {
    Route::get('', 'StockController@index')->name('index');
    Route::get('create', 'StockController@create')->name('create');
    Route::post('store', 'StockController@storeStock')->name('store');

    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'StockController@allStocks')->name('all');
    });

});