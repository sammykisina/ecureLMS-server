<?php

declare(strict_types=1);

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Services\Student\TaskService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class TaskIndexController extends Controller {
    public function __invoke(TaskService $taskService): JsonResponse {
        return response()->json(
            data: TaskResource::collection(
                resource: $taskService->getTasks()
            ),
            status: Http::OK()
        );
    }
}
