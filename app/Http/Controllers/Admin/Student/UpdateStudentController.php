<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentUpdateRequest;
use App\Http\Services\Admin\StudentService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class UpdateStudentController extends Controller {
    public function __invoke(
        StudentUpdateRequest $request,
        User $student,
        StudentService $studentService
    ): JsonResponse {
        if ($studentService->updateStudent(updateStudentData: $request->getUpdateStudentData(), student: $student)) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Student Updated Successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Student not updated.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
