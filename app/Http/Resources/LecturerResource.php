<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LecturerResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'type' => 'lecturer',
            'attributes' => [
                'workNumber' => $this->regNumber,
                'name' => $this->name,
                'email' => $this->email,
                'createdAt' => $this->created_at
            ],
            'relationships' => [
                'units' => UnitResource::collection(
                    $this->whenLoaded(
                        relationship: 'units'
                    )
                ),
                'tasks' => TaskResource::collection(
                    $this->whenLoaded(
                        relationship: 'tasks'
                    )
                ),
            ]
        ];
    }
}
