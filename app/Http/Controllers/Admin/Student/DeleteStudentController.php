<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\StudentService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class DeleteStudentController extends Controller {
    public function __invoke(
        User $student,
        StudentService $studentService
    ): JsonResponse {
        if ($studentService->deleteStudent(student: $student)) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Student Deleted Successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Student not deleted.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
