<?php
Route::group([ 'namespace' => 'MdhStaff', 'prefix' => 'staff',  'as' => 'staff.'], function() {
    Route::get('all-staff', 'MdhStaffController@getActiveUsers')->name("all_staff");

});
