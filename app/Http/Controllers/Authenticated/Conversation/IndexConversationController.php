<?php

declare(strict_types=1);

namespace App\Http\Controllers\Authenticated\Conversation;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Http\Services\Authenticated\ConversationService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class IndexConversationController extends Controller {
    public function __invoke(
        User $user,
        ConversationService $service
    ): JsonResponse {
        return new JsonResponse(
            data: ConversationResource::collection(
                resource: $service->getConversations(
                    user: $user
                )
            ),
            status: Http::OK()
        );
    }
}
