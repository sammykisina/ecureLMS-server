<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Services\Admin\CourseService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class IndexCourseController extends Controller {
    public function __invoke(CourseService $courseService): JsonResponse {
        return response()->json(
            data: CourseResource::collection(
                resource: $courseService->getCourses()
            ),
            status: Http::OK()
        );
    }
}
