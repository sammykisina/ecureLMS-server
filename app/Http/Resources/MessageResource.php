<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'type' => 'message',
            'attributes' => [
                'body' => $this->body,
                'read' => $this->read,
                'type' => $this->type,
                'createdAt' => $this->created_at->shortAbsoluteDiffForHumans(),
            ],
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
            ]
        ];
    }
}
