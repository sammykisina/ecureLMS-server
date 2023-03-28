<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Lecturer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LecturerUpdateRequest;
use App\Http\Services\Admin\LecturerService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use JustSteveKing\StatusCode\Http;

class UpdateLecturerController extends Controller {
    public function __invoke(
        LecturerUpdateRequest $request,
        User $lecturer,
        LecturerService $lecturerService
    ): JsonResponse {
        DB::beginTransaction();
        try {
            $lecturerService->updateLecturer(
                updateLecturerData: $request->getUpdatedLecturerData(),
                lecturer: $lecturer
            );

            $lecturer->units()->sync($request->get(key: 'unitIds'));
            DB::commit();

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Lecturer Updated Successfully.'
                ],
                status: Http::CREATED()
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Lecturer not updated.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
