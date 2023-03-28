<?php

declare(strict_types=1);

namespace App\Http\Controllers\Authenticated\Conversation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authenticated\CheckIfConversationExistsRequest;
use App\Http\Services\Authenticated\ConversationService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class CheckConversationExistsController extends Controller {
    public function __invoke(
        CheckIfConversationExistsRequest $request,
        ConversationService $service
    ): JsonResponse {
        if ($service->getConversation(
            senderId: $request->get(key: 'senderId'),
            receiverId: $request->get(key: 'receiverId')
        )) {
            return new JsonResponse(
                data: [
                    'error' => 0,
                    'message' => 'Conversation is among your chat list. Click it to chat.'
                ],
                status: Http::OK()
            );
        } else {
            if ($service->createConversation(
                newConversationData: $request->validated()
            )) {
                return new JsonResponse(
                    data: [
                        'error' => 0,
                        'message' => 'Conversation created.'
                    ],
                    status: Http::CREATED()
                );
            } else {
                return new JsonResponse(
                    data: [
                        'error' => 1,
                        'message' => 'Something went wrong. Conversation not created.'
                    ],
                    status: Http::NOT_IMPLEMENTED()
                );
            }
        }
    }
}
