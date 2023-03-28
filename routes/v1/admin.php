<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Course\DeleteCourseController;
use App\Http\Controllers\Admin\Course\IndexCourseController;
use App\Http\Controllers\Admin\Course\StoreCourseController;
use App\Http\Controllers\Admin\Course\UpdateCourseController;
use App\Http\Controllers\Admin\Lecturer\DeleteLecturerController;
use App\Http\Controllers\Admin\Lecturer\StoreLecturerController;
use App\Http\Controllers\Admin\Lecturer\UpdateLecturerController;
use App\Http\Controllers\Admin\Student\DeleteStudentController;
use App\Http\Controllers\Admin\Student\StoreStudentController;
use App\Http\Controllers\Admin\Student\UpdateStudentController;
use App\Http\Controllers\Admin\Unit\DeleteUnitController;
use App\Http\Controllers\Admin\Unit\StoreUnitController;
use App\Http\Controllers\Admin\Unit\UpdateUnitController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'students',
    'as' => 'students:',
], function () {
    Route::post('/', StoreStudentController::class)->name('studentStore');
    Route::patch('/{student}', UpdateStudentController::class)->name('studentUpdate');
    Route::delete('/{student}', DeleteStudentController::class)->name('studentDelete');
});

Route::group([
    'prefix' => 'courses',
    'as' => 'courses:',
], function () {
    Route::get('/', IndexCourseController::class)->name('courseIndex');
    Route::post('/', StoreCourseController::class)->name('courseStore');
    Route::patch('/{course}', UpdateCourseController::class)->name('courseUpdate');
    Route::delete('/{course}', DeleteCourseController::class)->name('courseDelete');
});

Route::group([
    'prefix' => 'units',
    'as' => 'units:',
], function () {
    Route::post('/', StoreUnitController::class)->name('unitStore');
    Route::patch('/{unit}', UpdateUnitController::class)->name('unitUpdate');
    Route::delete('/{unit}', DeleteUnitController::class)->name('unitDelete');
});

Route::group([
    'prefix' => 'lecturers',
    'as' => 'lecturers:',
], function () {
    Route::post('/', StoreLecturerController::class)->name('lecturerStore');
    Route::patch('/{lecturer}', UpdateLecturerController::class)->name('lecturerUpdate');
    Route::delete('/{lecturer}', DeleteLecturerController::class)->name('lecturerDelete');
});
