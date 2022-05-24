<?php
Route::group(['namespace' => 'SupplyChain', 'middleware' => ['web', 'auth'], 'prefix' => 'stocks', 'as' => 'stock.'], function () {
    Route::get('', 'GoodsController@index')->name('index');
    Route::get('create', 'GoodsController@create')->name('create');
    Route::post('store', 'GoodsController@storeStock')->name('store');


});

