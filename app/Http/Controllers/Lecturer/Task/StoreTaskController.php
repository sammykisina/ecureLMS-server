<?php

declare(strict_types=1);

namespace App\Http\Controllers\Lecturer\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lecturer\TaskStoreRequest;
use App\Http\Services\Lecturer\TaskService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class StoreTaskController extends Controller {
    public function __invoke(
        TaskStoreRequest $request,
        TaskService $taskService
    ): JsonResponse {
        if ($taskService->createTask(newTaskData:$request->getNewTaskData())) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Task Created Successfully.'
                ],
                status: Http::CREATED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Task not created.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
