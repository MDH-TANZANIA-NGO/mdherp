<?php
Route::group(['namespace' => 'SupplyChain', 'middleware' => ['web', 'auth'], 'prefix' => 'stocks', 'as' => 'stock.'], function () {
    Route::get('', 'GoodsController@index')->name('index');
    Route::get('create', 'GoodsController@create')->name('create');


});
Route::group(['namespace' => 'SupplyChain', 'middleware' => ['web', 'auth'], 'prefix' => 'stock-unit', 'as' => 'unit.'], function () {
    Route::get('', 'GoodsController@stockUnit')->name('unit');


});
