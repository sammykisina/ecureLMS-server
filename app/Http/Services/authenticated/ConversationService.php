<?php

declare(strict_types=1);

namespace App\Http\Services\Authenticated;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ConversationService {
    public function getConversations(User $user): Collection {
        return Conversation::query()
           ->where('senderId', $user->id)
           ->orWhere('receiverId', $user->id)
           ->orderBy('lastTimeMessage', 'DESC')
           ->with(['sender', 'receiver', 'messages.receiver', 'messages.sender'])
           ->get();
    }

    public function getConversation(int $senderId, int $receiverId): Conversation | null {
        return Conversation::query()
            ->where('receiverId', $senderId)
            ->where('senderId', $receiverId)
            ->orWhere('receiverId', $receiverId)
            ->where('senderId', $senderId)
            ->first();
    }

    public function createConversation(array $newConversationData): Conversation {
        return Conversation::create($newConversationData);
    }

    public function storeMessage(array $newMessageData, Conversation $conversation): Message {
        $message =  Message::create(
            array_merge(
                $newMessageData,
                ['conversation_id' => $conversation->id]
            )
        );

        $conversation->lastTimeMessage = $message->created_at;
        $conversation->save();
        return $message;
    }

    public function updateUnreadMessagesToRead(Message $message): bool {
        return $message->update([
            'read' => true
        ]);
    }
}
