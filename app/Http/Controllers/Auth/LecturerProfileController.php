<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\LecturerResource;
use App\Http\Services\Auth\ProfileService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class LecturerProfileController extends Controller {
    public function __invoke(
        User $lecturer,
        ProfileService $profileService
    ): JsonResponse {
        return response()->json(
            data: new LecturerResource(
                resource: $profileService->getLecturerProfile(lecturer: $lecturer)
            ),
            status: Http::OK()
        );
    }
}
