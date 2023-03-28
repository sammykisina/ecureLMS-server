<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'type' => 'unit',
            'attributes' => [
                'name' => $this->name,
                'createdAt' => $this->created_at
            ],
            'relationships' => [
                'course' => new CourseResource(
                    resource: $this->whenLoaded(
                        relationship: 'course'
                    )
                )
            ]
        ];
    }
}
