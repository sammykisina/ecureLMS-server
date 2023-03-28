<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Services\Admin\StudentService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class IndexStudentController extends Controller {
    public function __invoke(StudentService $studentService): JsonResponse {
        return response()->json(
            data: StudentResource::collection(
                resource: $studentService->getStudents()
            ),
            status: Http::OK()
        );
    }
}
