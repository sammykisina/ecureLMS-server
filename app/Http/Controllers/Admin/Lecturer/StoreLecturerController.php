<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Lecturer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LecturerStoreRequest;
use App\Http\Services\Admin\LecturerService;
use App\Notifications\AccountCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class StoreLecturerController extends Controller {
    public function __invoke(
        LecturerStoreRequest $request,
        LecturerService $lecturerService
    ) {
        DB::beginTransaction();
        try {
            $lecturer = $lecturerService->createLecturer(
                newLecturerData: $request->getNewLecturerData()
            );
            $lecturer->units()->sync($request->get(key: 'unitIds'));
            DB::commit();
            $lecturer->notify(new AccountCreated);

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Lecturer Created Successfully.'
                ],
                status: Http::CREATED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            DB::rollBack();
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Lecturer not created.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
