<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'type' => 'task',
            'attributes' => [
                'points' => $this->points,
                'doneIn' => $this->created_at,
                'task_id' => $this->task_id
            ],
            'relationships' => [
                'task' => new TaskResource(
                    resource: $this->whenLoaded(
                        relationship: 'task'
                    )
                ),
                'student' => new StudentResource(
                    resource: $this->whenLoaded(
                        relationship: 'student'
                    )
                )
            ]
        ];
    }
}
