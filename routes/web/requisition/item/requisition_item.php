<?php
Route::group(['namespace' => 'Requisition\Item', 'middleware' => ['web', 'auth'], 'prefix' => 'requisition-items', 'as' => 'requisition_type.'], function () {
    Route::post('requisitions/{requisition}/store', 'RequisitionItemController@store')->name('store');
    Route::put('{activity}/update', 'RequisitionItemController@update')->name('update');
});
