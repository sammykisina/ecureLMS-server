<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseUpdateRequest;
use App\Http\Services\Admin\CourseService;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class UpdateCourseController extends Controller {
    public function __invoke(
        CourseUpdateRequest $request,
        Course $course,
        CourseService $courseService
    ): JsonResponse {
        if ($courseService->updateCourse(updateCourseData: $request->getUpdatedStudentData(), course: $course)) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Course Updated Successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Course not updated.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
