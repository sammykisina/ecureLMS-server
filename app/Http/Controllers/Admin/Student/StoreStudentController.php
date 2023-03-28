<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentStoreRequest;
use App\Http\Services\Admin\StudentService;
use App\Notifications\AccountCreated;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class StoreStudentController extends Controller {
    public function __invoke(
        StudentStoreRequest $request,
        StudentService $studentService
    ): JsonResponse {
        if ($student = $studentService->createStudent(newStudentData: $request->getNewStudentData())) {
            $student->notify(new AccountCreated);
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Student Created Successfully.'
                ],
                status: Http::CREATED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Student not created.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
