<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Lecturer;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\LecturerService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class DeleteLecturerController extends Controller {
    public function __invoke(
        User $lecturer,
        LecturerService $lecturerService
    ): JsonResponse {
        $lecturer->units()->detach();
        if ($lecturerService->deleteLecturer(lecturer: $lecturer)) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Lecturer Deleted Successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Lecturer not deleted.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
