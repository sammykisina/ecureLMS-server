<?php

declare(strict_types=1);

namespace App\Http\Requests\Lecturer;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            'code' => [
                'required',
                'string',
                'unique:tasks,code'
            ],
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
            'lecturer_id' => [
                'required',
                'numeric',
                'exists:users,id'
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
            'bgColor' => [
                'required',
                'string'
            ]
        ];
    }

    public function getNewTaskData(): array {
        return $this->validated();
    }
}
