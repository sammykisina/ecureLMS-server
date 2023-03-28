<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Unit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UnitStoreRequest;
use App\Http\Services\Admin\UnitService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class StoreUnitController extends Controller {
    public function __invoke(
        UnitStoreRequest $request,
        UnitService $unitService
    ): JsonResponse {
        if ($unitService->createUnit(newUnitData:$request->getNewUnitData())) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Unit Created Successfully.'
                ],
                status: Http::CREATED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Unit not created.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
