<?php
Route::group(['namespace' => 'Account', 'middleware' => ['web', 'auth'], 'prefix' => 'accounts', 'as' => 'account.'], function () {
    Route::get('', 'AccountController')->name('index');
});


