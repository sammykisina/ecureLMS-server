<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Lecturer\IndexLecturerController;
use App\Http\Controllers\Admin\Student\IndexStudentController;
use App\Http\Controllers\Authenticated\Conversation\CheckConversationExistsController;
use App\Http\Controllers\Authenticated\Conversation\IndexConversationController;
use App\Http\Controllers\Authenticated\Conversation\StoreMessageController;
use App\Http\Controllers\Authenticated\Conversation\UpdateUnreadMessagesToReadController;
use App\Http\Controllers\Authenticated\IndexUnitController;
use Illuminate\Support\Facades\Route;

Route::get('/students', IndexStudentController::class)->name('studentIndex');
Route::get('/lecturers', IndexLecturerController::class)->name('lecturerIndex');

Route::group([
    'prefix' => 'units',
    'as' => 'units:',
], function () {
    Route::get('/', IndexUnitController::class)->name('unitIndex');
});

Route::group([
    'prefix' => 'conversations',
    'as' => 'conversations:',
], function () {
    Route::post('/exists', CheckConversationExistsController::class)->name('checkConversation');
    Route::get('/{user}', IndexConversationController::class)->name('getConversation');
    Route::post('/{conversation}/messages', StoreMessageController::class)->name('storeMessage');
    Route::patch('/messages', UpdateUnreadMessagesToReadController::class)->name('updateUnreadMessagesToRead');
});
