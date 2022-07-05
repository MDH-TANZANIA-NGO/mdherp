<?php


use App\Http\Controllers\web\Meetings\MeetingController;
use App\Http\Controllers\web\Event\EventController;
use App\Http\Controllers\Controller;
//Home Page
Route::get('/', function () {
    return view('welcome');
});


//Auth
Auth::routes();
//Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Meeting
Route::get('/meeting', [App\Http\Controllers\web\Meetings\MeetingController::class, 'index'])->name('meeting');
Route::get('/meeting.create', [App\Http\Controllers\web\Meetings\MeetingController::class, 'create'])->name('meeting.create');
Route::post('/meeting.store', [App\Http\Controllers\web\Meetings\MeetingController::class, 'store'])->name('meeting.store');
Route::post('/meeting.update/{id}', [App\Http\Controllers\web\Meetings\MeetingController::class, 'update'])->name('meeting.update');
Route::get('/meeting.edit/{meet}', [App\Http\Controllers\web\Meetings\MeetingController::class, 'edit'])->name('meeting.edit');
Route::get('/meeting.delete/{id}', [App\Http\Controllers\web\Meetings\MeetingController::class, 'delete'])->name('meeting.delete');
Route::get('/update/status/{user_id}/{status}', [MeetingController::class, 'updateStatus'])->name('meeting.status');



//Excel
Route::get('export', [App\Http\Controllers\web\Meetings\MeetingController::class, 'export'])->name('export');
Route::get('import', [App\Http\Controllers\web\Meetings\MeetingController::class, 'import'])->name('import');

//Event
Route::get('/event', [App\Http\Controllers\Web\Events\EventController::class, 'index'])->name('event');
Route::get('/event.create', [App\Http\Controllers\Web\Events\EventController::class, 'create'])->name('event.create');
Route::post('/event.store', [App\Http\Controllers\Web\Events\EventController::class, 'store'])->name('event.store');
Route::post('/event.update/{id}', [App\Http\Controllers\Web\Events\EventController::class, 'update'])->name('event.update');
Route::get('/event.edit/{id}', [App\Http\Controllers\Web\Events\EventController::class, 'edit'])->name('event.edit');
Route::get('/event.delete/{id}', [App\Http\Controllers\Web\Events\EventController::class, 'delete'])->name('event.delete');



//Time
Route::get('/time', [App\Http\Controllers\Web\Time\TimeController::class, 'time'])->name('time');
Route::post('/time/store', [App\Http\Controllers\Web\Time\TimeController::class, 'store'])->name('store-time');
Route::post('/time/update', [App\Http\Controllers\Web\Time\TimeController::class, 'update'])->name('update-time');
Route::get('/time/calc', [App\Http\Controllers\Web\Time\TimeController::class, 'calc'])->name('calc-time');
Route::get('/time/view/{id}', [App\Http\Controllers\Web\Time\TimeController::class, 'view'])->name('view-time');
Route::get('/time/view2/{id}', [App\Http\Controllers\Web\Time\TimeController::class, 'view2'])->name('view2-time');
Route::get('/time/viewall', [App\Http\Controllers\Web\Time\TimeController::class, 'viewall'])->name('viewall-time');
Route::get('/time/route', [App\Http\Controllers\Web\Time\TimeController::class, 'route'])->name('route-time');

Route::get('/time/show', [App\Http\Controllers\Web\Time\TimeController::class, 'show'])->name('time-show');

//Chart
Route::get('/chart', [App\Http\Controllers\ChartController::class, 'index'])->name('chart');
