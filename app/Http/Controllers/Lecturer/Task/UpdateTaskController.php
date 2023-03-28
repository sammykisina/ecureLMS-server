<?php

declare(strict_types=1);

namespace App\Http\Controllers\Lecturer\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lecturer\TaskUpdateRequest;
use App\Http\Services\Lecturer\TaskService;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class UpdateTaskController extends Controller {
    public function __invoke(
        TaskUpdateRequest $request,
        Task $task,
        TaskService $taskService
    ): JsonResponse {
        if ($taskService->updateTask(updatedTaskData:$request->getUpdatedTaskData(), task: $task)) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Task Updated Successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Task not updated.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
