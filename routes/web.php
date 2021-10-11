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
    if(access()->guest()) {
        return view('welcomepage');
    }else{
        return redirect()->route('workspace.invoke');
    }
});

Route::group(/*['middleware' => 'csrf'],*/['namespace' => 'Web','middleware' => ['web']], function () {
    includeRouteFiles(__DIR__.'/web/');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/updateuser', 'updateuser@index' )->name('updateuser');


