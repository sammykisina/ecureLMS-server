<?php

declare(strict_types=1);

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\ResultStoreRequest;
use App\Http\Services\Student\ResultService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class ResultStoreController extends Controller {
    public function __invoke(
        ResultStoreRequest $request,
        ResultService $resultService
    ): JsonResponse {
        if ($resultService->createResults(newResultData: $request->getNewResultData())) {
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Results created successful.'
                ],
                status: Http::CREATED()
            );
        } else {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something Went Wrong.Results not created'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
