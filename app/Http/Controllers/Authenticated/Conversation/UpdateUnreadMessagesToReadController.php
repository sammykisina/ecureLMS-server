<?php

declare(strict_types=1);

namespace App\Http\Controllers\Authenticated\Conversation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authenticated\UpdateUnreadMessagesToReadRequest;
use App\Http\Services\Authenticated\ConversationService;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class UpdateUnreadMessagesToReadController extends Controller {
    public function __invoke(
        UpdateUnreadMessagesToReadRequest $request,
        ConversationService $service
    ): JsonResponse {
        foreach ($request->get(key: 'unreadMessagesIds') as $unreadMessagesId) {
            $message = Message::query()->where('id', $unreadMessagesId)->first();
            $service->updateUnreadMessagesToRead(
                message: $message
            );
        }

        return new JsonResponse(
            data: [
                'error' => 0,
            ],
            status: Http::ACCEPTED()
        );
    }
}
