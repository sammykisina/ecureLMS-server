<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'type' => 'task',
            'attributes' => [
                'code' => $this->code,
                'description' => $this->description,
                'icon' => $this->icon,
                'numberOfQuestions' => $this->numberOfQuestions,
                'timeToTakeInTask' => $this->timeToTakeInTask,
                'numberOfPointsForEachQuestion' => $this->numberOfPointsForEachQuestion,
                'published' => $this->published,
                'bgColor' => $this->bgColor,
                'dueDate' => $this->dueDate,
                'numberOfValidDays' => $this->numberOfValidDays
            ],
            'relationships' => [
                'unit' => new UnitResource(
                    resource: $this->whenLoaded(
                        relationship: 'unit'
                    )
                ),
                'questions' => QuestionResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'questions'
                    )
                ),
                'results' => ResultResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'results'
                    )
                )

            ]
        ];
    }
}
