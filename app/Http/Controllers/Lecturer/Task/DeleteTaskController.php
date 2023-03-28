<?php

declare(strict_types=1);

namespace App\Http\Controllers\Lecturer\Task;

use App\Http\Controllers\Controller;
use App\Http\Services\Lecturer\TaskService;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class DeleteTaskController extends Controller {
    public function __invoke(
        Task $task,
        TaskService $taskService
    ): JsonResponse {
        try {
            if (!$task->published) {
                if ($taskService->deleteTask(task: $task)) {
                    return response()->json(
                        data: [
                            'error' => 0,
                            'message' => 'Task deleted successfully.'
                        ],
                        status: Http::ACCEPTED()
                    );
                }
            }
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong. Task not deleted.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
