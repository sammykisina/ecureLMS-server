<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseStoreRequest;
use App\Http\Services\Admin\CourseService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class StoreCourseController extends Controller {
    public function __invoke(
        CourseStoreRequest $request,
        CourseService $courseService
    ): JsonResponse {
        if ($courseService->createCourse(newCourseData: $request->getNewCourseData())) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Course Created Successfully.'
                ],
                status: Http::CREATED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Course not created.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
