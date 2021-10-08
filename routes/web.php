<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcomepage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/userslist', 'Userslist@index')->name('userslist');
Route::get('/userregister', 'Usersregister@index')->name('userregister');
Route::get('/updateuser', 'updateuser@index')->name('updateuser');