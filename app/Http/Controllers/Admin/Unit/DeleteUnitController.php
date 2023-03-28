<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Unit;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\UnitService;
use App\Models\Unit;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class DeleteUnitController extends Controller {
    public function __invoke(
        Unit $unit,
        UnitService $unitService
    ): JsonResponse {
        if ($unitService->deleteUnit(unit: $unit)) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Unit Deleted Successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Unit not deleted.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
