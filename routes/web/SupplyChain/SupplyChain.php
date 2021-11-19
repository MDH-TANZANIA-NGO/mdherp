<?php
Route::group(['namespace' => 'SupplyChain', 'middleware' => ['web', 'auth'], 'prefix' => 'stocks', 'as' => 'stock.'], function () {
    Route::get('', 'GoodsController@index')->name('index');
    Route::get('create', 'GoodsController@create')->name('create');
    Route::post('store', 'GoodsController@storeStock')->name('store');


});
Route::group(['namespace' => 'SupplyChain', 'middleware' => ['web', 'auth'], 'prefix' => 'stock-unit', 'as' => 'unit.'], function () {
    Route::get('', 'GoodsController@stockUnit')->name('unit');
    Route::post('store', 'GoodsController@storeUnit')->name('store');
    Route::get('edit', 'GoodsController@show')->name('edit');

    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::get('all', 'GoodsController@alldatatable')->name('all');
    });
});
