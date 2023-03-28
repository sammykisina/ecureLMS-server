<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LecturerProfileController;
use App\Http\Controllers\Lecturer\Question\StoreQuestionController;
use App\Http\Controllers\Lecturer\Task\DeleteTaskController;
use App\Http\Controllers\Lecturer\Task\StoreTaskController;
use App\Http\Controllers\Lecturer\Task\UpdateTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/{lecturer}/profile', LecturerProfileController::class)->name('lecturerProfile');

Route::group([
    'prefix' => 'tasks',
    'as' => 'tasks:',
], function () {
    Route::post('/', StoreTaskController::class)->name('taskStore');
    Route::patch('/{task}', UpdateTaskController::class)->name('taskUpdate');
    Route::delete('/{task}', DeleteTaskController::class)->name('taskDelete');

    Route::group([
        'prefix' => 'questions',
        'as' => 'question:'
    ], function () {
        Route::post('/', StoreQuestionController::class)->name('questionStore');
    });
});
