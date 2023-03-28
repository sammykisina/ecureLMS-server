<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Unit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UnitUpdateRequest;
use App\Http\Services\Admin\UnitService;
use App\Models\Unit;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class UpdateUnitController extends Controller {
    public function __invoke(
        UnitUpdateRequest $request,
        Unit $unit,
        UnitService $unitService
    ): JsonResponse {
        if ($unitService->updateUnit(updateUnitData: $request->getUpdateUnitData(), unit: $unit)) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Unit Updated Successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Unit not updated.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
