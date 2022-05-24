<?php
Route::group(['namespace' => 'Requisition\Item', 'middleware' => ['web', 'auth'], 'prefix' => 'requisition-items', 'as' => 'requisition_item.'], function () {
    Route::post('requisitions/{requisition}/store', 'RequisitionItemController@store')->name('store');
    Route::get('{uuid}/edit/{send}', 'RequisitionItemController@edit')->name('edit');
    Route::put('{uuid}/edit/{send}', 'RequisitionItemController@update')->name('update');
});
