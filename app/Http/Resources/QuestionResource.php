<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'type' => 'question',
            'attributes' => [
                'question' => $this->question,
                'correctAnswer' => $this->correctAnswer
            ],
            'relationships' => [
                'answers' => AnswerResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'answers'
                    )
                )
            ]
        ];
    }
}
