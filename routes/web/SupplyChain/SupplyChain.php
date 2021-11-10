<?php
Route::group(['namespace' => 'SupplyChain', 'middleware' => ['web', 'auth'], 'prefix' => 'goods', 'as' => 'good.'], function () {
    Route::get('', 'GoodsController@index')->name('index');
    Route::get('create', 'GoodsController@create')->name('create');


});
