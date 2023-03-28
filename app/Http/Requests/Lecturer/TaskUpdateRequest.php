<?php

declare(strict_types=1);

namespace App\Http\Requests\Lecturer;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest {
    public function rules(): array {
        return [
            'description' => [
                'required',
                'string'
            ],
            'icon' => [
                'required',
                'string'
            ],
            'numberOfQuestions' => [
                'required',
                'numeric'
            ],
            'unit_id' => [
                'required',
                'numeric',
                'exists:units,id'
            ],
            'numberOfValidDays' => [
                'required',
                'numeric',
                'min:1'
            ],
            'numberOfPointsForEachQuestion' => [
                'required',
                'numeric',
                'min:1'
            ],
            'timeToTakeInTask' => [
                'required',
                'numeric',
                'min:5'
            ],
        ];
    }

     public function getUpdatedTaskData(): array {
         return  $this->validated();
     }
}
