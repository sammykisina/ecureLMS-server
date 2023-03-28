<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'type' => 'course',
            'attributes' => [
                'name' => $this->name,
                'createdAt' => $this->created_at
            ],
            'relationships' => [
                'units' => UnitResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'units'
                    )
                )
            ]
        ];
    }
}
