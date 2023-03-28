<?php

declare(strict_types=1);

namespace App\Http\Controllers\Authenticated;

use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;
use App\Http\Services\Admin\UnitService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class IndexUnitController extends Controller {
    public function __invoke(UnitService $unitService): JsonResponse {
        return response()->json(
            data: UnitResource::collection(
                resource: $unitService->getUnits()
            ),
            status: Http::OK()
        );
    }
}
