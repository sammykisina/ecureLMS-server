<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'type' => 'student',
            'attributes' => [
                'regNumber' => $this->regNumber,
                'name' => $this->name,
                'email' => $this->email,
                'createdAt' => $this->created_at
            ],
            'relationships' => [
                'course' => new CourseResource(
                    resource: $this->whenLoaded(
                        relationship: 'course'
                    )
                ),
                'results' => ResultResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'results'
                    )
                ),
            ]
        ];
    }
}
