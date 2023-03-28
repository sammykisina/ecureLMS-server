<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Services\Auth\ProfileService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class StudentProfileController extends Controller {
    public function __invoke(
        User $student,
        ProfileService $profileService
    ): JsonResponse {
        return response()->json(
            data: new StudentResource(
                resource: $profileService->getStudentProfile(student: $student)
            ),
            status: Http::OK()
        );
    }
}
