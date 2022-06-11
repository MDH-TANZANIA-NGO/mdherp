<?php

use App\Http\Controllers\Web\Location\LocationController;
use App\Http\Controllers\Api\Location\GooglemapController;

    Route::get('location', [LocationController::class, 'location'])->name('location');
Route::get('map', [LocationController::class, 'map'])->name('map');

