<?php

declare(strict_types=1);

namespace App\Http\Controllers\Authenticated\Conversation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authenticated\MessageStoreRequest;
use App\Http\Resources\ConversationResource;
use App\Http\Services\Authenticated\ConversationService;
use App\Models\Conversation;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class StoreMessageController extends Controller {
    public function __invoke(
        MessageStoreRequest $request,
        Conversation $conversation,
        ConversationService $service
    ): JsonResponse {
        if ($service->storeMessage(
            newMessageData: $request->getNewMessageData(),
            conversation: $conversation
        )) {
            $conversation = Conversation::query()
                ->where('id', $conversation->id)
                ->orderBy('lastTimeMessage', 'DESC')
                ->with(['sender', 'receiver', 'messages.receiver','messages.sender'])
                ->first();

            return new JsonResponse(
                data: [
                    'error' => 0,
                    'message' => 'Message send successfully.',
                    'conversation' => new ConversationResource(
                        resource: $conversation
                    )
                ],
                status: Http::CREATED()
            );
        } else {
            return new JsonResponse(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong. Message not send.',
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
