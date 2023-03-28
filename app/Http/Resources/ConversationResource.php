<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'type' => 'conversation',
            'relationships' => [
                'sender' => new UserResource(
                    resource: $this->whenLoaded(
                        relationship: 'sender'
                    )
                ),
                'receiver' => new UserResource(
                    resource: $this->whenLoaded(
                        relationship: 'receiver'
                    )
                ),
                'messages' => MessageResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'messages'
                    )
                )
            ]
        ];
    }
}
