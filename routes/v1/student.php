<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\StudentProfileController;
use App\Http\Controllers\Student\ResultStoreController;
use App\Http\Controllers\Student\TaskIndexController;
use Illuminate\Support\Facades\Route;

Route::get('/{student}/profile', StudentProfileController::class)->name('studentProfile');

Route::group([
    'prefix' => 'tasks',
    'as' => 'tasks:',
], function () {
    Route::get('/', TaskIndexController::class)->name('taskIndex');

    Route::group([
        'prefix' => 'results',
        'as' => 'results:',
    ], function () {
        Route::post('/', ResultStoreController::class)->name('resultsStore');
    });
});
