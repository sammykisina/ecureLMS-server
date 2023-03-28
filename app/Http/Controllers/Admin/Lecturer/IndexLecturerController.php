<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Lecturer;

use App\Http\Controllers\Controller;
use App\Http\Resources\LecturerResource;
use App\Http\Services\Admin\LecturerService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class IndexLecturerController extends Controller {
    public function __invoke(LecturerService $lecturerService): JsonResponse {
        return response()->json(
            data: LecturerResource::collection(
                resource: $lecturerService->getLecturers()
            ),
            status: Http::OK()
        );
    }
}
