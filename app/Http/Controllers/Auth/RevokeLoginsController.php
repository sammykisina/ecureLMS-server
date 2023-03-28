<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class RevokeLoginsController extends Controller {
    public function __invoke(
        User $user
    ): JsonResponse {
        try {
            $user->tokens()->delete();
            return new JsonResponse(
                data: [
                    'error' => 0,
                    'message' => 'Revoking logins was successful.Click Login to access your account.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            return new JsonResponse(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Please contact admin immediately.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
