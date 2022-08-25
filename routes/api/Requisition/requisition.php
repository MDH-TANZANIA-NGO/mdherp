<?php
Route::group([ 'namespace' => 'Requisition', 'prefix' => 'requisition',  'as' => 'requisition.'], function() {
    Route::get('{region}/get-requisition-by-region', 'RequisitionController@getRegisteredByUser')->name("get_requisition_by_region");

});
