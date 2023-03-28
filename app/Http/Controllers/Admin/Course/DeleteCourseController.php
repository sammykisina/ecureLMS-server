<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\CourseService;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class DeleteCourseController extends Controller {
    public function __invoke(
        Course $course,
        CourseService $courseService
    ): JsonResponse {
        if ($courseService->deleteCourse(course: $course)) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Course Deleted Successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Course not deleted.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
